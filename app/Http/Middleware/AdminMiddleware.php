<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->isAdmin()) {
            return $next($request);  // Cho phép admin truy cập
        }

        return redirect('/');  // Nếu không phải admin, chuyển hướng về trang chủ
    }
}
