<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Post;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function threads()
    {
        $user = Auth::user();
        $threads = Thread::where('user_id', $user->id)->latest()->paginate(10);
        return view('users.threads', compact('threads'));
    }

    public function replies()
    {
        $user = Auth::user();
        $replies = Reply::with('post')->where('user_id', $user->id)->latest()->paginate(10);
        return view('users.replies', compact('replies'));
    }
    public function dashboard()
    {
        $user = Auth::user();
        $threadsCount = Thread::where('user_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $repliesCount = Reply::where('user_id', $user->id)->count();

        return view('users.dashboard', compact('threadsCount', 'postsCount', 'repliesCount'));
    }
    public function show()
    {
        if (!view()->exists('users.profile')) {
            abort(404, 'Không tìm thấy giao diện hồ sơ.');
        }
        $user = Auth::user();
        return view('users.profile', [
            'user' => $user,
            'threads' => $user->threads()->latest()->paginate(5),
            'posts' => $user->posts()->latest()->paginate(5),
            'replies' => $user->replies()->latest()->paginate(5),
        ]);
    }
}
