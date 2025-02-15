<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $categories = Category::with('threads')->get();
        $latestThreads = Thread::latest()->take(5)->get();
        return view('forum.index', compact('categories', 'latestThreads'));
    }

    public function showThread(Thread $thread)
    {
        $thread->load('posts.user', 'posts.replies');
        return view('forum.thread', compact('thread'));
    }

    public function createPost(Thread $thread)
    {
        return view('forum.create_post', compact('thread'));
    }

    public function storePost(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $thread->posts()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', $thread->id);
    }

    public function storeReply(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:3000',
        ]);

        $post->replies()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
