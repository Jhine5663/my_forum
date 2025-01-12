@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">Thêm người dùng</h1>
    
    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        
        <div class="mb-4">
            <label for="user_name" class="block text-sm font-semibold text-gray-700">Tên người dùng</label>
            <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" required 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('user_name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
            <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="is_admin" class="block text-sm font-semibold text-gray-700">Vai trò</label>
            <select name="is_admin" id="is_admin" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="0">Người dùng</option>
                <option value="1">Admin</option>
            </select>
        </div>            

        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Thêm người dùng</button>
    </form>
</div>
@endsection
