@extends('layouts.auth')
@section('auth-content')
    <div class="w-full max-w-md bg-gray-800 p-10 rounded-lg shadow-lg border border-blue-500/20">
        <h2 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-6">Đăng Ký</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-form-input name="user_name" label="Tên người dùng" :value="old('user_name')" required />
            <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
            <x-form-input name="password" label="Mật khẩu" type="password" required />
            <x-form-input name="password_confirmation" label="Xác nhận mật khẩu" type="password" required />
            <div class="flex items-center justify-between">
                <x-form-button label="Đăng Ký" />
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded pixel-btn">Thoát</a>
            </div>
        </form>
    </div>
@endsection

