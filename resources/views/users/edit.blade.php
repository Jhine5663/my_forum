@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Chỉnh sửa người dùng</h1>
    
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="user_name" class="block text-sm font-semibold text-gray-700">Tên người dùng</label>
            <input type="text" name="user_name" id="user_name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('user_name', $user->user_name) }}" required>
            @error('user_name')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="{{ old('email', $user->email) }}" required>
            @error('email')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu (Không thay đổi nếu để trống)</label>
            <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="is_admin" class="block text-sm font-semibold text-gray-700">Vai trò</label>
            <select name="is_admin" id="is_admin" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>Người dùng</option>
                <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật người dùng</button>
    </form>
    
</div>
@endsection
