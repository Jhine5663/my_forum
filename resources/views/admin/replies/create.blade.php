@extends('layouts.admin')

@section('title', 'Tạo Phản hồi mới | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tạo Phản hồi mới</h1>

        <form action="{{ route('admin.replies.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="post_id" class="block text-gray-700 text-sm font-bold mb-2">Chọn Bài viết gốc:</label>
                <select name="post_id" id="post_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">-- Chọn bài viết --</option>
                    @foreach($posts as $post)
                        <option value="{{ $post->id }}" {{ old('post_id', $selectedPost->id ?? '') == $post->id ? 'selected' : '' }}>
                            {{ Str::limit($post->content, 50) }} (Chủ đề: {{ Str::limit($post->thread->title ?? 'N/A', 30) }})
                        </option>
                    @endforeach
                </select>
                @error('post_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Người đăng:</label>
                <select name="user_id" id="user_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">-- Chọn người đăng --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', Auth::id()) == $user->id ? 'selected' : '' }}>
                            {{ $user->user_name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Nội dung Phản hồi:</label>
                <x-form-textarea id="comment" name="comment" rows="6" placeholder="Viết nội dung phản hồi..." required>{{ old('comment') }}</x-form-textarea>
                @error('comment')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tạo Phản hồi
                </x-form-button>
                <a href="{{ route('admin.replies.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection