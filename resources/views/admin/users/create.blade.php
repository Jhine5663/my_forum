@extends('layouts.admin')

@section('title', 'Tạo Người dùng mới | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tạo Người dùng mới</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Tên người dùng:</label>
                <x-form-input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" placeholder="Nhập tên người dùng" required autofocus />
                @error('user_name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <x-form-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email" required />
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mật khẩu:</label>
                <x-form-input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required />
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Xác nhận Mật khẩu:</label>
                <x-form-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu" required />
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_admin" value="1" class="form-checkbox text-blue-600 rounded" {{ old('is_admin') ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Là Quản trị viên</span>
                </label>
                @error('is_admin')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tạo Người dùng
                </x-form-button>
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection