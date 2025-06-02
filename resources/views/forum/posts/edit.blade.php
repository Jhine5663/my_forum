@extends('layouts.forum')

@section('title', 'Sửa Bài viết | Diễn đàn Game 2D')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-6 text-center">
            Sửa Bài viết
        </h1>

        <div class="bg-gray-800 p-8 shadow-xl rounded-lg border border-blue-500/30 game-card max-w-2xl mx-auto">
            <form action="{{ route('forum.posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="mb-6 p-4 bg-gray-700 rounded-lg border border-blue-600">
                    <p class="text-gray-300 text-base mb-2">Thuộc Chủ đề:</p>
                    <h2 class="text-xl font-bold text-blue-400">
                        <a href="{{ route('forum.threads.show', $post->thread) }}" class="hover:underline">{{ $post->thread->title }}</a>
                    </h2>
                    <p class="text-sm text-gray-400">Đăng bởi: {{ $post->user->name }} vào {{ $post->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-white text-lg font-semibold mb-2">Nội dung bài viết:</label>
                    <x-form-textarea id="content" name="content" rows="10"
                                     placeholder="Nội dung bài viết của bạn...">{{ old('content', $post->content) }}</x-form-textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center space-x-4">
                    <x-form-button type="submit" class="pixel-btn bg-blue-600 hover:bg-blue-700">
                        Cập nhật Bài viết
                    </x-form-button>
                    <a href="{{ route('forum.threads.show', $post->thread) }}" class="pixel-btn bg-gray-600 hover:bg-gray-700 text-white">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('sidebar')
    <x-sidebar />
@endsection