@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chi tiết bài viết</h1>
        <x-post-card :post="$post" />
        <h2 class="text-xl font-bold text-white mb-4">Bình luận</h2>
        @if($post->replies->isEmpty())
            <p class="text-gray-500">Chưa có bình luận nào.</p>
        @else
            <div class="ml-6 space-y-2">
                @foreach($post->replies as $reply)
                    <x-reply-card :reply="$reply" />
                @endforeach
            </div>
        @endif
        @auth
            <div class="mt-6">
                <a href="{{ route('forum.replies.create', $post) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Thêm bình luận</a>
            </div>
        @endauth
    </div>
@endsection