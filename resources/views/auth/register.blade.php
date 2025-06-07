@extends('layouts.auth')

@section('title', 'Đăng ký | 2D Game Hub')
{{-- Các meta tags khác đã được xử lý trong layouts/auth.blade.php --}}

@section('auth-form-content') {{-- Nội dung form sẽ được đặt vào yield này --}}
    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Thông báo lỗi tổng quát của Laravel --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Lỗi đăng ký!</strong>
                <span class="block sm:inline">Vui lòng kiểm tra thông tin.</span>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Trường Tên người dùng --}}
        <div class="input-group">
            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1 transition-colors">Tên người dùng</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('user_name') input-error @enderror"
                       placeholder="username" required autofocus>
            </div>
            @error('user_name')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Trường Email --}}
        <div class="input-group">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1 transition-colors">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') input-error @enderror"
                       placeholder="email@example.com" required>
            </div>
            @error('email')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Trường Mật khẩu --}}
        <div class="input-group">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1 transition-colors">Mật khẩu</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="password" id="password" name="password"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') input-error @enderror"
                       placeholder="••••••••" required>
                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password', 'eyeIconRegister')">
                    <i id="eyeIconRegister" class="fas fa-eye-slash"></i>
                </button>
            </div>
            @error('password')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Trường Xác nhận Mật khẩu --}}
        <div class="input-group">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1 transition-colors">Xác nhận mật khẩu</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock input-icon text-gray-400 transition-colors"></i>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password_confirmation') input-error @enderror"
                       placeholder="••••••••" required>
            </div>
            @error('password_confirmation')
                <p class="hidden text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Đồng ý điều khoản --}}
        {{-- <div class="flex items-center">
            <input id="terms" type="checkbox" name="terms" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" required>
            <label for="terms" class="ml-2 block text-sm text-gray-700">
                Tôi đồng ý với <a href="#" class="text-blue-600 hover:underline">Điều khoản dịch vụ</a>
            </label>
        </div> --}}
        
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg shadow transition-all duration-300 transform hover:scale-[1.02]">
            Đăng ký
        </button>
        
        <div class="text-center text-sm text-gray-500 pt-4">
            Đã có tài khoản? 
            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Đăng nhập ngay</a>
        </div>
    </form>

    {{-- Social login (có thể giữ lại nếu muốn triển khai) --}}
    <div class="mt-6">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Hoặc đăng ký bằng</span>
            </div>
        </div>
        
        <div class="mt-4 grid grid-cols-3 gap-3">
            <button type="button" class="w-full inline-flex justify-center py-2 px-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fab fa-google text-red-500 text-lg"></i>
            </button>
            <button type="button" class="w-full inline-flex justify-center py-2 px-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fab fa-facebook text-blue-600 text-lg"></i>
            </button>
            <button type="button" class="w-full inline-flex justify-center py-2 px-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fab fa-discord text-indigo-600 text-lg"></i>
            </button>
        </div>
    </div>
@endsection