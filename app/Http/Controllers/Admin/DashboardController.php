<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
// use Illuminate\Support\Facades\Cache; 
// use Illuminate\Support\Facades\Gate; 

class DashboardController extends Controller 
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index() 
    {
        $stats = [
            'userCount' => User::count(),
            'threadCount' => Thread::count(),
            'categoryCount' => Category::count(),
            'postCount' => Post::count(),
            'replyCount' => Reply::count(),
        ];

        $recentPosts = Post::with('user')->latest()->take(5)->get(); // Eager load user

        return view('admin.dashboard', array_merge($stats, ['recentPosts' => $recentPosts]));
    }
}