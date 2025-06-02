<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Category;
use App\Models\User; 
use App\Models\Post; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $threads = Thread::with(['user', 'category'])->withCount('posts')->paginate(10);
        return view('admin.threads.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        $posts = $thread->posts()->with(['user', 'replies.user'])->paginate(10);
        return view('admin.threads.show', compact('thread', 'posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.threads.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id', 
            'content' => 'required|string', 
        ]);

        $thread = Thread::create([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'user_id' => $validatedData['user_id'], 
        ]);

        $thread->posts()->create([
            'content' => $validatedData['content'],
            'user_id' => $validatedData['user_id'],
        ]);

        return redirect()->route('admin.threads.index')->with('success', 'Chủ đề admin đã được tạo thành công.');
    }

    public function edit(Thread $thread)
    {
        $categories = Category::all();
        $users = User::all(); 
        return view('admin.threads.edit', compact('thread', 'categories', 'users'));
    }

    public function update(Request $request, Thread $thread)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id', 
        ]);

        $thread->update($validatedData);

        return redirect()->route('admin.threads.index')->with('success', 'Chủ đề admin đã được cập nhật thành công.');
    }

    public function destroy(Thread $thread)
    {
        $thread->posts->each(function ($post) {
            $post->replies()->delete();
            $post->delete();
        });

        $thread->delete();
        return redirect()->route('admin.threads.index')->with('success', 'Chủ đề và tất cả bài viết/bình luận liên quan đã được xóa.');
    }
}