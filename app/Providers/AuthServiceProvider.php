<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,  // Đảm bảo đăng ký Policy cho User
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Đăng ký Gate cho quyền truy cập admin
        Gate::define('access-admin', function ($user) {
            return $user->is_admin;  // Kiểm tra nếu user là admin
        });
    }
}

