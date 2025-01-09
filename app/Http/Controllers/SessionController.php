<?php

namespace App\Http\Controllers;
;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Xác thực người dùng
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Tạo session mới để bảo mật
            return redirect('/profile')->with('success', 'Đăng nhập thành công!');
        }
    
        // Xử lý nếu đăng nhập thất bại
        throw ValidationException::withMessages([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }
    
    public function destroy(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate(); // Huỷ session hiện tại
        $request->session()->regenerateToken(); // Tạo token mới để tránh CSRF
    
        return redirect('/login')->with('success', 'Đăng xuất thành công!');
    }
    
}
