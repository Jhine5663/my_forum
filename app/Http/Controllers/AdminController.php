<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->middleware('auth');
            $this->middleware('admin');

            return $next($request);
        });

    }

    public function dashboard()
    {
        if (!view()->exists('admin.dashboard')) {
            abort(404, 'Không tìm thấy giao diện admin.');
        }

        $stats = [
            'userCount' => User::count(),
            'threadCount' => Thread::count(),
            'categoryCount' => Category::count(),
            'postCount' => Post::count(),
            'replyCount' => Reply::count(),
        ];

        $recentPosts = Post::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', array_merge($stats, ['recentPosts' => $recentPosts]));
    }
}
