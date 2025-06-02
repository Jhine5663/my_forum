@extends('layouts.admin')

@section('admin-content')
    <div class="p-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold pixel-font text-blue-500 glow-text mb-8">Bảng điều khiển Admin</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="p-4 bg-green-700 rounded-lg game-card flex items-center space-x-4">
                <i class="fas fa-users text-3xl text-blue-500"></i>
                <div>
                    <h2 class="text-lg text-gray-200 pixel-font">Người dùng</h2>
                    <p class="text-2xl text-blue-300">{{ $userCount }}</p>
                </div>
            </div>
            <div class="p-4 bg-green-700 rounded-lg game-card flex items-center space-x-4">
                <i class="fas fa-comments text-3xl text-blue-500"></i>
                <div>
                    <h2 class="text-lg text-gray-200 pixel-font">Chủ đề</h2>
                    <p class="text-2xl text-blue-300">{{ $threadCount }}</p>
                </div>
            </div>
            <div class="p-4 bg-green-700 rounded-lg game-card flex items-center space-x-4">
                <i class="fas fa-folder text-3xl text-blue-500"></i>
                <div>
                    <h2 class="text-lg text-gray-200 pixel-font">Chuyên mục</h2>
                    <p class="text-2xl text-blue-300">{{ $categoryCount }}</p>
                </div>
            </div>
            <div class="p-4 bg-green-700 rounded-lg game-card flex items-center space-x-4">
                <i class="fas fa-file-alt text-3xl text-blue-500"></i>
                <div>
                    <h2 class="text-lg text-gray-200 pixel-font">Bài viết</h2>
                    <p class="text-2xl text-blue-300">{{ $postCount }}</p>
                </div>
            </div>
            <div class="p-4 bg-green-700 rounded-lg game-card flex items-center space-x-4">
                <i class="fas fa-comment-dots text-3xl text-blue-500"></i>
                <div>
                    <h2 class="text-lg text-gray-200 pixel-font">Bình luận</h2>
                    <p class="text-2xl text-blue-300">{{ $replyCount }}</p>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold pixel-font text-blue-500 glow-text mb-6">Bài viết mới nhất</h2>

        @if($recentPosts->isEmpty())
            <p class="text-gray-400 text-lg">Chưa có bài viết nào.</p>
        @else
            <div class="space-y-6">
                @foreach($recentPosts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
