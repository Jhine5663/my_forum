@extends('layouts.admin')

@section('title', 'Sửa Phản hồi | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Sửa Phản hồi: {{ Str::limit($reply->comment, 30) }}</h1>

        <form action="{{ route('admin.replies.update', $reply) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-700 text-sm mb-2">
                    Gốc từ Bài viết: <a href="{{ route('admin.posts.show', $reply->post) }}" class="text-blue-600 hover:underline">{{ Str::limit($reply->post->content, 50) }}</a>
                </p>
                <p class="text-gray-700 text-sm">
                    Người đăng: <a href="{{ route('admin.users.show', $reply->user) }}" class="text-blue-600 hover:underline">{{ $reply->user->user_name }}</a> vào {{ $reply->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="mb-4">
                <label for="post_id" class="block text-gray-700 text-sm font-bold mb-2">Bài viết gốc:</label>
                <select name="post_id" id="post_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($posts as $post)
                        <option value="{{ $post->id }}" {{ old('post_id', $reply->post_id) == $post->id ? 'selected' : '' }}>
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
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $reply->user_id) == $user->id ? 'selected' : '' }}>
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
                <x-form-textarea id="comment" name="comment" rows="6" placeholder="Nội dung phản hồi..." required>{{ old('comment', $reply->comment) }}</x-form-textarea>
                @error('comment')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Cập nhật Phản hồi
                </x-form-button>
                <a href="{{ route('admin.replies.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection