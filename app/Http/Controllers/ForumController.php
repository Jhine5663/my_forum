<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['createThread', 'storeThread', 'createPost', 'storePost', 'storeReply']);
    }
    public function index()
    {
        $categories = Category::with(['threads' => fn($query) => $query->latest()->take(5)])->get();
        $latestThreads = Thread::latest()->take(5)->get();
        return view('forum.index', compact('categories', 'latestThreads'));
    }

    public function showThread(Thread $thread)
    {
        $thread->load(['posts.user', 'posts.replies' => fn($query) => $query->latest()->take(10)]);
        return view('forum.thread', compact('thread'));
    }

    public function storeReply(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:3000|not_regex:/^\s*$/',
        ]);

        $post->replies()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', $post->thread)->with('success', 'Bình luận đã được thêm.');
    }
}
