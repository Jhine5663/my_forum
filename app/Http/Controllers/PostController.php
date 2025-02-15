<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    
    public function show(Post $post)
    {
        $replies = $post->replies;
        return view('posts.show', compact('post', 'replies')); 
    }

    public function create(Thread $thread)
    {
        return view('posts.create', compact('thread'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'thread_id' => 'required|exists:threads,id',
        ]);
    
        Post::create([
            'content' => $request->input('content'),
            'thread_id' => $request->input('thread_id'),
            'user_id' => $request->user()->id,
        ]);
    
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được thêm thành công.');
    }
        
    
    public function edit(Post $post)
    {
        $thread = $post->thread; // Truyền chủ đề tương ứng của bài viết
        return view('posts.edit', compact('post', 'thread'));
    }
    
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $post->update([
            'content' => $request->input('content'),
        ]);
    
        return redirect()->route('posts.index', $post->thread)
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }
    
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Chỉ người tạo bài viết mới có quyền xóa
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
