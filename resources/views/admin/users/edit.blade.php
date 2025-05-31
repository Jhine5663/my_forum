@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-700 glow-text mb-4">Sửa người dùng</h1>
    <div class="bg-White-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form-input name="user_name" label="Tên người dùng" :value="$user->user_name" required />
            <x-form-input name="email" label="Email" type="email" :value="$user->email" required />
            <x-form-input name="password" label="Mật khẩu mới (để trống nếu không đổi)" type="password" />
            <x-form-input name="password_confirmation" label="Xác nhận mật khẩu" type="password" />
            <div class="mb-4">
                <label for="is_admin" class="block text-gray-600 font-bold mb-2">Admin</label>
                @if ($user->id !== auth()->id())
                    <input type="hidden" name="is_admin" value="0">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1"
                        {{ $user->is_admin ? 'checked' : '' }}
                        class="rounded bg-gray-700 text-blue-500 focus:ring-blue-500">
                @else
                    <input type="checkbox" id="is_admin" value="1" checked disabled
                        class="rounded bg-gray-700 text-blue-500 focus:ring-blue-500">
                    <p class="text-gray-400 text-sm italic">Bạn không thể thay đổi quyền admin của chính mình.</p>
                @endif
            </div>
            <div class="flex space-x-4">
                <x-form-button label="Cập nhật" />
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection
