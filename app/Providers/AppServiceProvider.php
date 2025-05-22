<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Thread;
use App\Models\Post;
use App\Models\Category;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */


    /**
     * Register any authentication/authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        View::composer('components.sidebar', function ($view) {
            $view->with([
                'categories'  => Category::all(),
                'userCount'   => User::count(),
                'threadCount' => Thread::count(),
                'postCount'   => Post::count(),
            ]);
        });
    }
}

