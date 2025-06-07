<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request; 

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

        $recentPosts = Post::with(['user', 'thread.category'])->latest()->take(5)->get();

        // New Members 
        $newMembers = User::latest()->take(3)->get();

        // Recent Reports 
        // $recentReports = Report::with('user')->latest()->take(3)->get();

        return view('admin.dashboard', array_merge($stats, [
            'recentPosts' => $recentPosts,
            'newMembers' => $newMembers, 
            // 'recentReports' => $recentReports, 
        ]));
    }
}