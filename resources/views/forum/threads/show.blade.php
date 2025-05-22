@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">{{ $thread->title }}</h1>
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-4">
            <p class="text-white">Đăng bởi {{ $thread->user->user_name }} trong
                <a href="{{ route('categories.show', $thread->category) }}" class="text-blue-400 hover:underline">{{ $thread->category->name }}</a>
            </p>
            <p class="text-sm text-gray-400">Ngày đăng: {{ $thread->created_at->format('d/m/Y') }}</p>
        </div>
        <h2 class="text-xl font-bold text-white mb-4">Bài viết</h2>
        @if($thread->posts->isEmpty())
            <p class="text-gray-500">Chưa có bài viết nào.</p>
        @else
            <div class="space-y-4">
                @foreach($thread->posts as $post)
                    <x-post-card :post="$post" />
                    @if($post->replies->isNotEmpty())
                        <div class="ml-6 space-y-2">
                            @foreach($post->replies as $reply)
                                <x-reply-card :reply="$reply" />
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
        @auth
            <div class="mt-6">
                <a href="{{ route('forum.posts.create', $thread) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Viết bài</a>
            </div>
        @endauth
    </div>
@endsection