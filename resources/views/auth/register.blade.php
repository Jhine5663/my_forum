@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-10 rounded-lg shadow-lg">
        <form method="POST" action="/register" class="w-full max-w-lg">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="user_name">Tên người dùng</label>
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('user_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Đăng ký
                </button>
                <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Thoát</a>
            </div>
        </form>
    </div>
</div>

@endsection
