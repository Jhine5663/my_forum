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
            $user = Auth::user(); // Lấy người dùng hiện tại (nếu có)
            $view->with('categories', Category::where('is_active', true)->get());
            $view->with('userCount', User::count());
            $view->with('threadCount', Thread::count());
            $view->with('postCount', Post::count());
            $view->with('latestThreads', Thread::latest()->take(5)->get());
            // Thêm các biến khác nếu sidebar của Người cần, ví dụ: 'trendingThreads'
            // $view->with('trendingThreads', SomeTrendModel::getTrending()); // Sẽ được tích hợp sau khi có ML
            // Lấy Hoạt động gần đây cho sidebar
            $recentSidebarActivities = collect();
            // Lấy hoạt động từ user đã đăng nhập, hoặc hoạt động chung nếu user là khách
            if ($user) {
                $recentThreads = $user->threads()->latest()->take(3)->get();
                $recentPosts = $user->posts()->latest()->take(3)->get();
                $recentReplies = $user->replies()->with('post')->latest()->take(3)->get();
            } else {
                $recentThreads = Thread::latest()->take(5)->get(); // Hoạt động chung cho khách
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
            $recentSidebarActivities = $recentSidebarActivities->sortByDesc('created_at')->take(5); // Lấy top 5 hoạt động tổng hợp
            $view->with('recentSidebarActivities', $recentSidebarActivities);

            // Lấy Chủ đề nổi bật (từ ML sau này, hiện tại có thể là latestThreads hoặc most commented/viewed)
            $trendingTopics = Thread::latest()->take(5)->get(); // Ví dụ: 5 chủ đề mới nhất
            // $trendingTopics = Thread::withCount('posts')->orderByDesc('posts_count')->take(5)->get(); // 5 chủ đề nhiều bài viết nhất
            $view->with('trendingTopics', $trendingTopics);

            // Lấy Thành viên tích cực nhất (top 5 theo số lượng bài viết)
            $topMembers = User::withCount('posts')
                ->orderByDesc('posts_count')
                ->take(5)
                ->get();
            $view->with('topMembers', $topMembers);
        });
    }
}
