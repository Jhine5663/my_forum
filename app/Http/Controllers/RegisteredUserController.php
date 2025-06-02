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
        $this->middleware('guest')->only(['create', 'store']); 
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
            'password' => ['required', 'confirmed', Password::min(6)], 
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'is_admin' => false, 
        ]);

        Auth::login($user); 

        return redirect()->route('profile.show')->with('success', 'Đăng ký thành công!');
    }

}