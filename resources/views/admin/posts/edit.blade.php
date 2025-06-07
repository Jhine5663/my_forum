@extends('layouts.admin')

@section('title', 'Sửa Bài viết | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Sửa Bài viết: {{ Str::limit($post->content, 30) }}</h1>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Thông tin Bài viết gốc (không sửa được) --}}
            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-700 text-sm mb-2">
                    Thuộc Chủ đề: <a href="{{ route('admin.threads.show', $post->thread) }}" class="text-blue-600 hover:underline">{{ $post->thread->title }}</a>
                </p>
                <p class="text-gray-700 text-sm">
                    Đăng bởi: <a href="{{ route('admin.users.show', $post->user) }}" class="text-blue-600 hover:underline">{{ $post->user->user_name }}</a> vào {{ $post->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            {{-- Trường chọn Chủ đề (admin có thể thay đổi thread của post) --}}
            <div class="mb-4">
                <label for="thread_id" class="block text-gray-700 text-sm font-bold mb-2">Chủ đề:</label>
                <select name="thread_id" id="thread_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($threads as $thread)
                        <option value="{{ $thread->id }}" {{ old('thread_id', $post->thread_id) == $thread->id ? 'selected' : '' }}>
                            {{ Str::limit($thread->title, 50) }} (Tạo bởi: {{ $thread->user->user_name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('thread_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường chọn Người đăng (Admin có thể thay đổi người đăng) --}}
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Người đăng:</label>
                <select name="user_id" id="user_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->user_name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Nội dung Bài viết:</label>
                <x-form-textarea id="content" name="content" rows="10" placeholder="Nội dung bài viết..." required>{{ old('content', $post->content) }}</x-form-textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Cập nhật Bài viết
                </x-form-button>
                <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection