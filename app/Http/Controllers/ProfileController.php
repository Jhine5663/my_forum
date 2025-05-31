<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Post;
use Illuminate\Validation\Rules\Can;

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
            'categories' => Category::all(),
            'user' => $user,
            'userCount' => \App\Models\User::count(),
            'threadCount' => \App\Models\Thread::count(),
            'postCount' => \App\Models\Post::count(),
        ]);
    }
    public function edit_profile()
    {
        $user = Auth::user();
        $categories = Category::all(); 
        return view('users.edit-profile', [
            'user'=> $user, 
            'categories' => $categories,
            'userCount' => \App\Models\User::count(),
            'threadCount' => \App\Models\Thread::count(),
            'postCount' => \App\Models\Post::count(),
        ]);
    }
}
