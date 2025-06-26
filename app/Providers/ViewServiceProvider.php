<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // <-- Thêm dòng này

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ các biến này với component 'components.sidebar'
        View::composer('components.sidebar', function ($view) {
            $user = Auth::user();
            $view->with('categories', Category::where('is_active', true)->get());
            $view->with('userCount', User::count());
            $view->with('threadCount', Thread::count());
            $view->with('postCount', Post::count());
            $view->with('latestThreads', Thread::latest()->take(5)->get());

            // Lấy Hoạt động gần đây
            $recentSidebarActivities = collect();
            if ($user) {
                $recentThreads = $user->threads()->latest()->take(3)->get();
                $recentPosts = $user->posts()->latest()->take(3)->get();
                $recentReplies = $user->replies()->with('post')->latest()->take(3)->get();
            } else {
                $recentThreads = Thread::latest()->take(5)->get();
                $recentPosts = Post::latest()->take(5)->get();
                $recentReplies = Reply::with('post')->latest()->take(5)->get();
            }
            foreach ($recentThreads as $thread) {
                $thread->type = 'thread';
                $recentSidebarActivities->push($thread);
            }
            foreach ($recentPosts as $post) {
                $post->type = 'post';
                $recentSidebarActivities->push($post);
            }
            foreach ($recentReplies as $reply) {
                $reply->type = 'reply';
                $recentSidebarActivities->push($reply);
            }
            $view->with('recentSidebarActivities', $recentSidebarActivities->sortByDesc('created_at')->take(5));

            // Lấy Chủ đề nổi bật (hiện tại là mới nhất)
            $view->with('trendingTopics', Thread::latest()->take(5)->get());

            // Lấy Thành viên tích cực nhất
            $view->with('topMembers', User::withCount('posts')->orderByDesc('posts_count')->take(5)->get());

            // Lấy "Từ khóa xu hướng" từ ML đã được lưu trong Cache
            $trendingKeywords = \Illuminate\Support\Facades\Cache::get('trending_keywords', []);
            // dd($trendingKeywords);
            $view->with('trendingKeywords', $trendingKeywords); // 
        });
    }
}
