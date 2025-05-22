@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Diễn đàn Game 2D</h1>
        @auth
            <x-form-button label="Tạo chủ đề" type="button" onclick="window.location.href='{{ route('forum.threads.create') }}'" />
        @endauth
        @if($categories->isEmpty())
            <p class="text-gray-500">Chưa có danh mục nào.</p>
        @else
            @foreach($categories as $category)
                <div class="bg-gray-800 p-4 mb-4 shadow-md rounded-lg border border-blue-500/20 game-card">
                    <h2 class="text-lg font-bold text-white">
                        <a href="{{ route('categories.show', $category) }}" class="hover:text-blue-400">{{ $category->name }}</a>
                    </h2>
                    @if($category->threads->isEmpty())
                        <p class="text-gray-500">Chưa có chủ đề.</p>
                    @else
                        @foreach($category->threads->take(3) as $thread)
                            <x-thread-card :thread="$thread" />
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection


