@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-4 shadow rounded-md">
            <h2 class="text-lg font-semibold">Người dùng</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $userCount }}</p>
            <a href="/users" class="text-sm text-blue-500 hover:underline">Quản lý người dùng</a>
        </div>
        <div class="bg-white p-4 shadow rounded-md">
            <h2 class="text-lg font-semibold">Thể loại</h2>
            <p class="text-2xl font-bold text-green-600">{{ $categoryCount }}</p>
            <a href="/categories" class="text-sm text-green-500 hover:underline">Quản lý thể loại</a>
        </div>
        <div class="bg-white p-4 shadow rounded-md">
            <h2 class="text-lg font-semibold">Chủ đề</h2>
            <p class="text-2xl font-bold text-yellow-600">{{ $threadCount }}</p>
            <a href="/threads" class="text-sm text-yellow-500 hover:underline">Quản lý chủ đề</a>
        </div>
        <div class="bg-white p-4 shadow rounded-md">
            <h2 class="text-lg font-semibold">Bài viết</h2>
            <p class="text-2xl font-bold text-red-600">{{ $postCount }}</p>
            <a href="/posts" class="text-sm text-red-500 hover:underline">Quản lý bài viết</a>
        </div>
        <div class="bg-white p-4 shadow rounded-md">
            <h2 class="text-lg font-semibold">Bình luận</h2>
            <p class="text-2xl font-bold text-purple-600">{{ $replyCount }}</p>
            <a href="/replies" class="text-sm text-purple-500 hover:underline">Quản lý bình luận</a>
        </div>
    </div>
</div>
@endsection
