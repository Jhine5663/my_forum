@extends('layouts.auth')
@section('auth-content')
    <div class="w-full max-w-md bg-gray-800 p-10 rounded-lg shadow-lg border border-blue-500/20">
        <h2 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-6">Đăng Nhập</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
            <x-form-input name="password" label="Mật khẩu" type="password" required />
            <div class="flex items-center justify-between">
                <x-form-button label="Đăng Nhập" />
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded pixel-btn">Đăng ký</a>
            </div>
        </form>
    </div>
@endsection

