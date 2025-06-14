@extends('layouts.forum')

@section('title', 'Sửa Hồ sơ của tôi | 2D Game Hub')
@section('meta_description', 'Chỉnh sửa thông tin hồ sơ cá nhân của bạn trên 2D Game Hub.')

@section('forum-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center justify-center">
            <i class="fas fa-user-edit text-blue-600 mr-3"></i> Sửa Hồ sơ của tôi
        </h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT') {{-- Sử dụng PUT method cho cập nhật --}}

            {{-- Thông báo thành công/thất bại --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Trường Tên người dùng --}}
            <div class="input-group">
                <label for="user_name" class="block text-gray-700 text-sm font-bold mb-1 transition-colors">Tên người dùng:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user input-icon text-gray-400 transition-colors"></i>
                    </div>
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('user_name') input-error @enderror"
                           placeholder="Nhập tên người dùng của bạn" required autofocus>
                </div>
                @error('user_name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường Email --}}
            <div class="input-group">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-1 transition-colors">Email:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope input-icon text-gray-400 transition-colors"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') input-error @enderror"
                           placeholder="Nhập địa chỉ email của bạn" required>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường Mật khẩu mới (để trống nếu không đổi) --}}
            <div class="input-group">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-1 transition-colors">Mật khẩu mới (để trống nếu không đổi):</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock input-icon text-gray-400 transition-colors"></i>
                    </div>
                    <input type="password" id="password" name="password"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') input-error @enderror"
                           placeholder="Nhập mật khẩu mới">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password', 'eyeIconPassword')">
                        <i id="eyeIconPassword" class="fas fa-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường Xác nhận Mật khẩu mới --}}
            <div class="input-group">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-1 transition-colors">Xác nhận Mật khẩu mới:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock input-icon text-gray-400 transition-colors"></i>
                    </div>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password_confirmation') input-error @enderror"
                           placeholder="Xác nhận mật khẩu mới">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation', 'eyeIconConfirmPassword')">
                        <i id="eyeIconConfirmPassword" class="fas fa-eye-slash"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường Avatar --}}
            <div class="input-group">
                <label for="avatar" class="block text-gray-700 text-sm font-bold mb-1 transition-colors">Ảnh đại diện:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-image input-icon text-gray-400 transition-colors"></i>
                    </div>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('avatar') input-error @enderror">
                </div>
                @error('avatar')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                @if($user->avatar)
                    <p class="text-gray-600 text-sm mt-2 flex items-center">
                        Ảnh đại diện hiện tại:
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="w-16 h-16 rounded-full object-cover ml-3 border-2 border-blue-300 shadow-sm">
                    </p>
                @endif
            </div>
            
            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg shadow transition-all duration-300 transform hover:scale-[1.02]">
                    Cập nhật Hồ sơ
                </button>
                <a href="{{ route('profile.show') }}" class="ml-4 text-gray-600 hover:text-gray-800 text-sm font-medium">Hủy</a>
            </div>
        </form>
    </div>
@endsection
