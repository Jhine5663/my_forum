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
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-threads')) {
                abort(403, 'Bạn không có quyền quản lý chủ đề.');
            }
            return $next($request);
        })->except(['index', 'show']);
    }

    public function index()
    {
        $threads = Thread::with('user')->paginate(10);
        return view('threads.index', compact('threads'));
    }
    public function show(Thread $thread)
    {
        if (!$thread->is_active) {
            abort(404, 'Chủ đề không hoạt động.');
        }
        $thread->load(['posts.user', 'posts.replies.user', 'category', 'user']);
        $latestThreads = Thread::latest()->take(5)->get();
        return view('threads.show', compact('thread', 'latestThreads'));
    }

    public function create()
    {
        $this->authorize('createAsAdmin', Thread::class);

        $categories = Category::all();
        return view('threads.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->authorize('createAsAdmin', Thread::class);

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

        return redirect()->route('threads.show', $thread)
            ->with('success', 'Chủ đề admin đã được tạo thành công.');
    }

    public function edit(Thread $thread)
    {
        $categories = Category::all();
        return view('threads.edit', compact('thread', 'categories'));
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

        return redirect()->route('threads.index');
    }

    public function destroy(Thread $thread)
    {
        if ($thread->posts()->exists()) {
            return redirect()->route('threads.index')->with('error', 'Không thể xóa chủ đề vì còn chứa bài viết.');
        }
        $thread->delete();
        return redirect()->route('threads.index')->with('success', 'Chủ đề đã được xóa.');
    }
}
