@extends('layouts.auth')

@section('auth-title', 'Register to Game 2D Forum')

@section('auth-content')
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <x-form-input name="user_name" label="Tên người dùng" :value="old('user_name')" required />
        <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
        <x-form-input name="password" label="Mật khẩu" type="password" required />
        <x-form-input name="password_confirmation" label="Xác nhận mật khẩu" type="password" required />
        <div class="flex justify-between items-center mt-4">
            <x-form-button label="Đăng Ký" />
            <a href="{{ route('login') }}" class="pixel-btn bg-blue-500 hover:bg-blue-700">Thoát</a>
        </div>
    </form>
@endsection