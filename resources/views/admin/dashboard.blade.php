@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Bảng điều khiển Admin</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
            <h2 class="text-lg text-white">Người dùng</h2>
            <p class="text-2xl text-blue-400">{{ $userCount }}</p>
        </div>
        <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
            <h2 class="text-lg text-white">Chủ đề</h2>
            <p class="text-2xl text-blue-400">{{ $threadCount }}</p>
        </div>
        <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
            <h2 class="text-lg text-white">Danh mục</h2>
            <p class="text-2xl text-blue-400">{{ $categoryCount }}</p>
        </div>
        <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
            <h2 class="text-lg text-white">Bài viết</h2>
            <p class="text-2xl text-blue-400">{{ $postCount }}</p>
        </div>
        <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
            <h2 class="text-lg text-white">Bình luận</h2>
            <p class="text-2xl text-blue-400">{{ $replyCount }}</p>
        </div>
    </div>
    <h2 class="text-xl font-bold text-white mb-4">Bài viết mới nhất</h2>
    @if($recentPosts->isEmpty())
        <p class="text-gray-500">Chưa có bài viết nào.</p>
    @else
        <div class="space-y-4">
            @foreach($recentPosts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    @endif
@endsection
