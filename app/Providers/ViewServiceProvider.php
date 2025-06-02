<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;

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
            $view->with('categories', Category::where('is_active', true)->get());
            $view->with('userCount', User::count());
            $view->with('threadCount', Thread::count());
            $view->with('postCount', Post::count());
            $view->with('latestThreads', Thread::latest()->take(5)->get());
            // Thêm các biến khác nếu sidebar của Người cần, ví dụ: 'trendingThreads'
            // $view->with('trendingThreads', SomeTrendModel::getTrending()); // Sẽ được tích hợp sau khi có ML
        });
    }
}