<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // Lưu email vào DB hoặc gửi mail
        return redirect()->back()->with('success', 'Đã đăng ký newsletter!');
    }
}
