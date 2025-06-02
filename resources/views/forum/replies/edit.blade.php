@extends('layouts.forum')

@section('title', 'Sửa Phản hồi | Diễn đàn Game 2D')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-6 text-center">
            Sửa Phản hồi
        </h1>

        <div class="bg-gray-800 p-8 shadow-xl rounded-lg border border-blue-500/30 game-card max-w-2xl mx-auto">
            <form action="{{ route('forum.replies.update', $reply) }}" method="POST">
                @csrf
                @method('PUT') {{-- Bắt buộc phải có để Laravel nhận diện là PUT request --}}

                {{-- Thông tin Bài viết gốc --}}
                <div class="mb-6 p-4 bg-gray-700 rounded-lg border border-blue-600">
                    <p class="text-gray-300 text-base mb-2">Phản hồi cho bài viết:</p>
                    <h2 class="text-xl font-bold text-blue-400">
                        <a href="{{ route('forum.threads.show', $reply->post->thread) }}#post-{{ $reply->post->id }}" class="hover:underline">{{ Str::limit($reply->post->content, 80) }}</a>
                    </h2>
                    <p class="text-sm text-gray-400">Đăng bởi: {{ $reply->post->user->name }} vào {{ $reply->post->created_at->format('d/m/Y H:i') }}</p>
                </div>

                {{-- Trường nội dung phản hồi --}}
                <div class="mb-6">
                    <label for="comment" class="block text-white text-lg font-semibold mb-2">Nội dung phản hồi:</label>
                    <x-form-textarea id="comment" name="comment" rows="6"
                                     placeholder="Nội dung phản hồi của bạn...">{{ old('comment', $reply->comment) }}</x-form-textarea>
                    @error('comment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nút gửi --}}
                <div class="flex justify-center space-x-4">
                    <x-form-button type="submit" class="pixel-btn bg-blue-600 hover:bg-blue-700">
                        Cập nhật Phản hồi
                    </x-form-button>
                    <a href="{{ route('forum.threads.show', $reply->post->thread) }}#post-{{ $reply->post->id }}" class="pixel-btn bg-gray-600 hover:bg-gray-700 text-white">
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