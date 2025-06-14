<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\DB; // <-- Thêm dòng này

class DashboardController extends Controller
{
    public function index()
    {
        // --- DỮ LIỆU THỐNG KÊ TỔNG QUAN (GIỮ NGUYÊN) ---
        $userCount = User::count();
        $threadCount = Thread::count();
        $postCount = Post::count();
        $replyCount = Reply::count();
        $recentPosts = Post::with('thread.category')->latest()->take(5)->get();
        $newMembers = User::latest()->take(5)->get();

        // === BẮT ĐẦU PHẦN CHUẨN BỊ DỮ LIỆU CHO BIỂU ĐỒ ===

        // --- 1. Dữ liệu Tăng trưởng thành viên (30 ngày qua) ---
        $userGrowthData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        // --- 2. Dữ liệu Hoạt động diễn đàn (Threads và Posts trong 30 ngày qua) ---
        $threadActivityData = Thread::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        $postActivityData = Post::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        // --- 3. Xử lý dữ liệu để điền các ngày không có hoạt động ---
        $dates = collect();
        for ($i = 29; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $userGrowthCounts = $dates->map(fn ($date) => $userGrowthData->get($date, 0));
        $threadActivityCounts = $dates->map(fn ($date) => $threadActivityData->get($date, 0));
        $postActivityCounts = $dates->map(fn ($date) => $postActivityData->get($date, 0));


        // --- 4. Truyền tất cả dữ liệu sang view ---
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'threadCount' => $threadCount,
            'postCount' => $postCount,
            'replyCount' => $replyCount,
            'recentPosts' => $recentPosts,
            'newMembers' => $newMembers,
            
            // Dữ liệu mới cho biểu đồ
            'chartLabels' => $dates->map(fn ($date) => date('d/m', strtotime($date))),
            'userGrowthCounts' => $userGrowthCounts,
            'threadActivityCounts' => $threadActivityCounts,
            'postActivityCounts' => $postActivityCounts,
        ]);
    }
}