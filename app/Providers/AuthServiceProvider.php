<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\PostPolicy;
use App\Models\Post;
use App\Models\Reply;
use App\Policies\UserPolicy;
use App\Policies\ReplyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,  
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Reply::class => ReplyPolicy::class,      
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            return $user->is_admin;  // Kiểm tra nếu user là admin
        });
    }
}

