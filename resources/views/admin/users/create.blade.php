@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Tạo người dùng</h1>
    <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <x-form-input name="user_name" label="Tên người dùng" :value="old('user_name')" required />
            <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
            <x-form-input name="password" label="Mật khẩu" type="password" required />
            <x-form-input name="password_confirmation" label="Xác nhận mật khẩu" type="password" required />
            <div class="mb-4">
                <label for="is_admin" class="block text-gray-300 font-bold mb-2">Admin</label>
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }} class="rounded bg-gray-700 text-blue-500 focus:ring-blue-500">
            </div>
            <div class="flex space-x-4">
                <x-form-button label="Tạo" />
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection