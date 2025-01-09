@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Chỉnh sửa người dùng</h1>
    
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
            <input type="text" name="user_name" id="user_name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password (Leave blank if not changing)</label>
            <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật người dùng</button>
    </form>
</div>
@endsection
