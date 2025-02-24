<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Gate;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        // Kiểm tra quyền admin cho tất cả các method
        $this->middleware(function ($request, $next) {
            if (Gate::denies('access-admin')) {
                abort(403, 'Bạn không có quyền truy cập trang này.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'threadCount' => Thread::count(),
            'categoryCount' => Category::count(),
            'postCount' => Post::count(),
            'replyCount' => Reply::count(),
        ]);
    }
    
}

