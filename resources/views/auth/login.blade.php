@extends('layouts.auth')

@section('title', 'Đăng nhập | 2D Game Hub')
{{-- Các meta tags khác đã được xử lý trong layouts/auth.blade.php --}}

@section('auth-form-content') {{-- Nội dung form sẽ được đặt vào yield này --}}
    <form action="{{ route('session.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Thông báo lỗi tổng quát của Laravel --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Lỗi đăng nhập!</strong>
                <span class="block sm:inline">Vui lòng kiểm tra thông tin.</span>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Trường Email --}}
        <div class="input-group">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1 transition-colors">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') input-error @enderror"
                       placeholder="email@example.com" required autofocus>
            </div>
            @error('email')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p> 
            @enderror
        </div>
        
        {{-- Trường Mật khẩu --}}
        <div class="input-group">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700 transition-colors">Mật khẩu</label>
                <a href="#" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">Quên mật khẩu?</a>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="password" id="password" name="password"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') input-error @enderror"
                       placeholder="••••••••" required>
                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password', 'eyeIconLogin')">
                    <i id="eyeIconLogin" class="fas fa-eye-slash"></i>
                </button>
            </div>
            @error('password')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Ghi nhớ đăng nhập --}}
        <div class="flex items-center">
            <input id="remember-me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ghi nhớ đăng nhập</label>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg shadow transition-all duration-300 transform hover:scale-[1.02]">
            Đăng nhập
        </button>
        
        <div class="text-center text-sm text-gray-500 pt-4">
            Bạn chưa có tài khoản? 
            <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Đăng ký ngay</a>
        </div>
    </form>
@endsection