@extends('layouts.auth')

@section('auth-title', 'Login to Game 2D Forum')

@section('auth-content')
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
        <x-form-input name="password" label="Mật khẩu" type="password" required />
        <div class="flex justify-between items-center mt-4">
            <x-form-button label="Đăng Nhập" />
            <a href="{{ route('register') }}" class="pixel-btn bg-blue-500 hover:bg-blue-700">Đăng Ký</a>
        </div>
    </form>
@endsection