<?php

namespace App\Http\Controllers; //

use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $replies = Reply::with('post.thread')->where('user_id', $user->id)->latest()->paginate(10); 
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
        $user = Auth::user();
        return view('users.profile', [
            'user' => $user,
        ]);
    }

    public function edit_profile()
    {
        $user = Auth::user();
        return view('users.edit-profile', compact('user'));
    }

}