@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Thêm người dùng</h1>
    
    <form action="{{ route('users.store') }}" method="POST">
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
            <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
            <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="is_admin" class="block text-sm font-semibold text-gray-700">Vai trò</label>
            <select name="is_admin" id="is_admin" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="0">Người dùng</option>
                <option value="1">Admin</option>
            </select>
        </div>            
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Thêm người dùng</button>
    </form>
    
</div>
@endsection
