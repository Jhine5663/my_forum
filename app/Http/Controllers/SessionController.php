<?php

namespace App\Http\Controllers;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['create', 'store']);
        $this->middleware('auth')->only('destroy');
        $this->middleware('throttle:10,1')->only('store');
    }
    public function create()
    {
        if (!view()->exists('auth.login')) {
            abort(404, 'Không tìm thấy trang đăng nhập.');
        }
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác. Vui lòng thử lại.',
            ])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->route('profile.show')->with('success', 'Đăng nhập thành công!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Huỷ session hiện tại
        $request->session()->regenerateToken(); // Tạo token mới để tránh CSRF

        return redirect('/login')->with('success', 'Đăng xuất thành công!');
    }
}
