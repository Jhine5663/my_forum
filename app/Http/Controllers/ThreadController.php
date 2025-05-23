<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin');
    }

    public function index()
    {
        $threads = Thread::with('user')->paginate(10);
        if (request()->routeIs('admin.*')) {
            return view('admin.threads.index', compact('threads'));
        }
        return view('forum.threads.index', compact('threads'));
    }
    public function show(Thread $thread)
    {
        if (!$thread->is_active) {
            abort(404, 'Chủ đề không hoạt động.');
        }
        $thread->load(['posts.user', 'posts.replies.user', 'category', 'user']);
        $latestThreads = Thread::latest()->take(5)->get();
        return view('forum.threads.show', compact('thread', 'latestThreads'));
    }

    public function create()
    {
        $categories = Category::all();
        if (request()->routeIs('admin.*')) {
            return view('admin.threads.create', compact('categories'));
        }
        return view('forum.threads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread = Thread::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'user_id' => Auth::user()->id,
            'is_admin' => true,
        ]);
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.threads.index', $thread)
                ->with('success', 'Chủ đề admin đã được tạo thành công.');
        }
        return redirect()->route('forum.threads.show', $thread)
            ->with('success', 'Chủ đề được tạo thành công.');
    }

    public function edit(Thread $thread)
    {
        if (Auth::id() !== $thread->user_id && !Auth::user()->is_admin) {
            abort(403, 'Bạn không có quyền sửa chủ đề này.');
        }
        $categories = Category::all();
        if (request()->routeIs('admin.*')) {
            return view('admin.threads.edit', compact('thread', 'categories'));
        }
        return view('forum.threads.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['title', 'body', 'category_id']);
        $thread->update($data);
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.threads.index', $thread)
                ->with('success', 'Chủ đề admin đã được cập nhật thành công.');
        }
        return redirect()->route('forum.threads.show', $thread)
            ->with('success', 'Chủ đề đã được cập nhật thành công.');
    }

    public function destroy(Thread $thread)
    {
        $isAdminRoute = request()->routeIs('admin.*');

        if ($thread->posts()->exists() && $isAdminRoute) {
            return redirect()->route('admin.threads.index')
                ->with('error', 'Không thể xóa chủ đề vì còn chứa bài viết.');
        }

        if ($thread->posts()->exists()) {
            return redirect()->route('forum.threads.index');
        }

        $thread->delete();

        if ($isAdminRoute) {
            return redirect()->route('admin.threads.index')
                ->with('success', 'Chủ đề đã được xóa.');
        }

        return redirect()->route('forum.threads.index')
            ->with('success', 'Chủ đề đã được xóa.');
    }
}
