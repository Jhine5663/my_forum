<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Thread; 
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $posts = Post::with('user', 'thread.category')->paginate(10);
        Post::with(['user', 'thread.category'])->withCount('replies')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $replies = $post->replies()->with('user')->get(); 
        return view('admin.posts.show', compact('post', 'replies'));
    }

    public function create(Request $request) 
    {
        $threads = Thread::all(); 
        $categories = Category::all(); 
        $selectedThread = null;
        Thread::with('user')->get();
        $users = User::all();
        if ($request->has('thread_id')) {
            $selectedThread = Thread::find($request->thread_id);
        }
        return view('admin.posts.create', compact('threads', 'categories', 'selectedThread', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
            'thread_id' => 'required|exists:threads,id',
            'user_id' => 'required|exists:users,id', 
        ]);

        Post::create([
            'content' => $request->content,
            'thread_id' => $request->thread_id,
            'user_id' => $request->user_id, 
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được thêm thành công.');
    }

    public function edit(Post $post)
    {
        $threads = Thread::all(); 
        $users = User::all();
        return view('admin.posts.edit', compact('post', 'threads', 'users'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
            'thread_id' => 'required|exists:threads,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update([
            'content' => $request->content,
            'thread_id' => $request->thread_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công.');
    }
}