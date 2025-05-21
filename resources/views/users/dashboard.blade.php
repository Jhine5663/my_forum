@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6">Tổng quan tài khoản</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Chủ đề đã tạo</h3>
            <p class="text-3xl font-bold text-blue-500">{{ $threadsCount }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Bài viết</h3>
            <p class="text-3xl font-bold text-green-500">{{ $postsCount }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Phản hồi</h3>
            <p class="text-3xl font-bold text-purple-500">{{ $repliesCount }}</p>
        </div>
    </div>
</div>
@endsection
