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
        // Kiểm tra quyền admin cho tất cả các method
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
            }
            if (Gate::denies('access-admin')) {
                abort(403, 'Bạn không có quyền truy cập trang này.');
            }
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
            'replyCount' => Post::count(), 
        ];

        $recentPosts = Post::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', array_merge($stats, ['recentPosts' => $recentPosts]));
    }
}
