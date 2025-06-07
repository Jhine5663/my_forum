@extends('layouts.admin')

@section('title', 'Tạo Danh mục mới | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tạo Danh mục mới</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tên Danh mục:</label>
                <x-form-input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Lập trình game 2D" required autofocus />
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug (URL thân thiện):</label>
                <x-form-input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="lap-trinh-game-2d" />
                <p class="text-gray-500 text-xs mt-1">Để trống nếu muốn tự động tạo từ tên danh mục.</p>
                @error('slug')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Mô tả:</label>
                <x-form-textarea id="description" name="description" rows="4" placeholder="Mô tả ngắn gọn về danh mục này...">{{ old('description') }}</x-form-textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="form-checkbox text-blue-600 rounded" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Hoạt động (Hiển thị trên diễn đàn)</span>
                </label>
                @error('is_active')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tạo Danh mục
                </x-form-button>
                <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection