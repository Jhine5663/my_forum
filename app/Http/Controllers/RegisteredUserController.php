<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function edit_profile()
    {
        return view('edit-profile');
    }
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'unique:users,user_name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);
    
        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
        ]);
    
        Auth::login($user); // Đăng nhập ngay sau khi đăng ký
    
        return redirect('/profile')->with('success', 'Đăng ký thành công!');
    }
    
}
