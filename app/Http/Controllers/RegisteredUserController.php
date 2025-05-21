<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['edit_profile', 'update_profile']);
        $this->middleware('guest')->only(['create', 'store']);
    }
    public function edit_profile()
    {
        if (!view()->exists('users.edit-profile')) {
            abort(404, 'Không tìm thấy giao diện.');
        }
        $user = Auth::user();
        return view('users.edit-profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'user_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9_]+$/|unique:users,user_name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('user_name', 'email'));

        return redirect()->route('profile.show')->with('success', 'Cập nhật hồ sơ thành công.');
    }

    public function index()
    {
        return redirect()->route('profile.show');
    }
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {

        $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
        ]);

        Auth::login($user); // Đăng nhập ngay sau khi đăng ký

        return redirect()->route('profile.show')->with('success', 'Đăng ký thành công!');
    }
}
