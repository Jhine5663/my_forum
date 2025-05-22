@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Dashboard của {{ Auth::user()->user_name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
                <h2 class="text-lg text-white">Chủ đề đã tạo</h2>
                <p class="text-2xl text-blue-400">{{ $user->threads()->count() }}</p>
            </div>
            <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
                <h2 class="text-lg text-white">Bài viết đã đăng</h2>
                <p class="text-2xl text-blue-400">{{ $user->posts()->count() }}</p>
            </div>
            <div class="bg-gray-800 p-4 shadow-md rounded-lg border border-blue-500/20 game-card">
                <h2 class="text-lg text-white">Bình luận đã viết</h2>
                <p class="text-2xl text-blue-400">{{ $user->replies()->count() }}</p>
            </div>
        </div>
        <h2 class="text-xl font-bold text-white mb-4">Chủ đề gần đây</h2>
        @if($recentThreads->isEmpty())
            <p class="text-gray-500">Bạn chưa tạo chủ đề nào gần đây.</p>
        @else
            <div class="space-y-4">
                @foreach($recentThreads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>
        @endif
    </div>
@endsection