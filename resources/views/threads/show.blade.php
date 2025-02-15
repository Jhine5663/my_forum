@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Chủ đề -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800">{{ $thread->title }}</h1>
        <p class="text-gray-600 text-sm">📁 {{ $thread->category->name }} - ✍ {{ $thread->user->user_name }} - ⏳ {{ $thread->created_at->diffForHumans() }}</p>
        <div class="mt-4 text-gray-700">
            {{ $thread->content }}
        </div>
    </div>

    <!-- Danh sách bài viết -->
    <div class="mt-6">
        <h2 class="text-2xl font-semibold text-blue-700">📢 Các bài viết trong chủ đề</h2>
        <div class="bg-white p-5 rounded-lg shadow-lg">
            @forelse ($thread->posts as $post)
                <div class="border-b pb-4 mb-4">
                    <p class="text-gray-800">{{ $post->content }}</p>
                    <p class="text-sm text-gray-500">✍ {{ $post->user->user_name }} - ⏳ {{ $post->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-500">🚫 Chưa có bài viết nào.</p>
            @endforelse
        </div>
    </div>

    <!-- Form thêm bài viết -->
    @auth
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-blue-700">✍ Viết bài</h2>
        <form action="{{ route('posts.store', $thread->id) }}" method="POST" class="bg-white p-5 rounded-lg shadow-lg mt-3">
            @csrf
            <textarea name="content" rows="4" class="w-full p-3 border rounded-lg" placeholder="Viết nội dung bài viết..."></textarea>
            <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Gửi bài viết</button>
        </form>
    </div>
    @endauth
</div>
@endsection
