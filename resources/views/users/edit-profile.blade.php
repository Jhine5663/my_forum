@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6 max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold pixel-font text-blue-900 glow-text mb-6">Chỉnh sửa hồ sơ</h1>
        <div class="bg-white/90 p-8 rounded-lg shadow-md border border-[#93c5fd]">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="auth-form" style="gap: 1.5rem;">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <x-form-input name="user_name" label="Tên người dùng" :value="$user->user_name" required />
                </div>
                <div class="space-y-4">
                    <x-form-input name="email" label="Email" type="email" :value="$user->email" required />
                </div>
                <div class="space-y-4">
                    <label for="avatar" class="block text-gray-800 text-lg font-medium">Avatar</label>
                    <div id="avatar-preview" class="mb-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-3xl text-gray-600"></i>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
                    <label for="avatar" class="pixel-btn bg-blue-500 hover:bg-blue-700 inline-block cursor-pointer">Chọn ảnh</label>
                    @error('avatar')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-4">
                    <x-form-input name="old_password" label="Mật khẩu cũ (nếu muốn đổi mật khẩu)" type="password" />
                </div>
                <div class="space-y-4">
                    <x-form-input name="password" label="Mật khẩu mới" type="password" />
                </div>
                <div class="space-y-4">
                    <x-form-input name="password_confirmation" label="Xác nhận mật khẩu mới" type="password" />
                </div>
                <div class="flex justify-end mt-6">
                    <x-form-button label="Cập nhật" class="px-6 py-3" />
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');

        avatarInput.addEventListener('change', function(e) {
            if (e.target.files[0]) {
                const preview = document.createElement('img');
                preview.src = URL.createObjectURL(e.target.files[0]);
                preview.className = 'w-24 h-24 rounded-full object-cover';
                avatarPreview.innerHTML = '';
                avatarPreview.appendChild(preview);
            }
        });
    });
</script>