<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    public function index()
    {
        $categories = Category::with(['threads' => fn($query) => $query->latest()->take(5)])->get();
        $latestThreads = Thread::latest()->take(5)->get();
        return view('forum.index', [
            'categories' => Category::all(),
            'latestThreads' => $latestThreads,
            'userCount' => User::count(),
            'threadCount' => Thread::count(),
            'postCount' => Post::count(),
        ]);
    }
    public function showThread(Thread $thread)
    {
        $categories = Category::all();
        $posts = $thread->posts()->with('user')->paginate(10);

        return view('forum.threads.show', [
            'thread' => $thread,
            'posts' => $posts,
            'categories' => $categories,
            'userCount' => User::count(),
            'threadCount' => Thread::count(),
            'postCount' => Post::count(),
        ]);
    }
}
