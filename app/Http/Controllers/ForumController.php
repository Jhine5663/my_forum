<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class ForumController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $categories = Category::with('threads')->get();
        $latestThreads = Thread::latest()->take(5)->get();
        return view('forum.index', compact('categories', 'latestThreads'));
    }
    
    public function showThread(Thread $thread)
    {
        $thread = Thread::findOrFail($thread->id);
        
        return view('forum.thread_show', compact('thread'));
    }
    

    public function createPost(Thread $thread)
    {
        $this->authorize('create', Post::class);

        return view('forum.create_post', compact('thread'));
    }

    public function storePost(Request $request, Thread $thread)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $thread->posts()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.thread_show', ['thread' => $thread->id])
        ->with('success', 'Bài viết đã được đăng thành công!');
    
    }

    public function storeReply(Request $request, Post $post)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'content' => 'required|string|max:3000',
        ]);

        $post->replies()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'thread_id' => $post->thread_id,
        ]);

        return redirect()->back()->with('success', 'Phản hồi đã được đăng!');
    }
}
