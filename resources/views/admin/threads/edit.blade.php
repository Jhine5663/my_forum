@extends('layouts.admin')

@section('title', 'Sửa Chủ đề: ' . Str::limit($thread->title, 30) . ' | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Sửa Chủ đề: "{{ Str::limit($thread->title, 50) }}"</h1>

        <form action="{{ route('admin.threads.update', $thread) }}" method="POST">
            @csrf
            @method('PUT') {{-- Quan trọng: Sử dụng PUT method cho cập nhật --}}

            {{-- Trường tiêu đề --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Tiêu đề Chủ đề:</label>
                <x-form-input type="text" id="title" name="title" value="{{ old('title', $thread->title) }}" placeholder="Nhập tiêu đề chủ đề" required autofocus />
                @error('title')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường chọn Danh mục --}}
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Chọn Danh mục:</label>
                <select name="category_id" id="category_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $thread->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường chọn Người tạo (Admin có thể thay đổi người tạo của thread) --}}
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Người tạo:</label>
                <select name="user_id" id="user_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $thread->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->user_name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tùy chọn: Trường nội dung bài viết đầu tiên nếu Người cho phép sửa đổi --}}
            {{-- Nếu Người muốn sửa đổi nội dung bài viết đầu tiên của thread ngay tại đây, hãy bỏ chú thích --}}
            {{--
            <div class="mb-6">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Nội dung bài viết đầu tiên:</label>
                <x-form-textarea id="content" name="content" rows="10" placeholder="Nội dung chính của chủ đề...">{{ old('content', $thread->posts->first()->content ?? '') }}</x-form-textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            --}}

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Cập nhật Chủ đề
                </x-form-button>
                <a href="{{ route('admin.threads.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection