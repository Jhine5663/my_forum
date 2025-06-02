@extends('layouts.forum')

@section('meta_description', 'Các chủ đề thảo luận về ' . $category->name . ' trong diễn đàn game 2D.')
@section('meta_keywords', '{{ $category->name }}, game 2D, indie game, lập trình game, {{ $category->name }} threads')
@section('og_title', 'Chuyên mục: ' . $category->name . ' | Diễn đàn Game 2D')
@section('og_description', 'Khám phá các chủ đề và thảo luận sôi nổi trong chuyên mục ' . $category->name . ' của diễn đàn game 2D.')
@section('og_image', asset($category->image_url ?? 'images/default_category_og_image.png'))

@section('forum-content')
    <div class="flex-1 p-6">
        <nav class="text-sm font-semibold mb-4 flex items-center space-x-2">
            <a href="{{ route('forum.index') }}" class="text-blue-400 hover:text-blue-300">
                <i class="fas fa-home"></i> Diễn đàn
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-blue">{{ $category->name }}</span>
        </nav>

        <div class="bg-gray-800 p-6 mb-6 shadow-xl rounded-lg border border-blue-500/30 game-card">
            <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-2">
                {{ $category->name }}
            </h1>
            <p class="text-gray-600 text-base mb-4">
                {{ $category->description ?? 'Nơi thảo luận các chủ đề liên quan đến ' . $category->name . '.' }}
            </p>
            <div class="text-sm text-gray-400">
                <span class="mr-4"><i class="fas fa-comments"></i> Tổng số chủ đề: {{ $category->threads_count ?? $category->threads->count() }}</span>
            </div>

            @auth
                <div class="mt-4">
                    <a href="{{ route('forum.threads.create', ['category_id' => $category->id]) }}"
                       class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 w-fit">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tạo chủ đề mới trong {{ $category->name }}</span>
                    </a>
                </div>
            @else
                <p class="text-gray-400 text-sm mt-4">
                    <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Đăng nhập</a> để tạo chủ đề mới.
                </p>
            @endauth
        </div>

        <h2 class="text-xl font-bold pixel-font text-blue-400 glow-text mb-4 border-b border-blue-500/20 pb-2">
            Các chủ đề trong chuyên mục này
        </h2>

        @if ($threads->isEmpty())
            <div class="bg-gray-800 p-4 mb-4 shadow-md rounded-lg border border-gray-700">
                <p class="text-gray-400 text-center">Chưa có chủ đề nào trong chuyên mục này. Hãy là người đầu tiên tạo một chủ đề!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($threads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>

            <div class="mt-6">
                {{ $threads->links() }}
            </div>
        @endif
    </div>

    @section('sidebar')
        <x-sidebar>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md mb-4 border border-blue-500/20">
                <h3 class="text-lg font-semibold text-white mb-3 pixel-font">Chủ đề Nổi bật từ {{ $category->name }}</h3>
                @if(!empty($trendingThreadsInCategory) && $trendingThreadsInCategory->count() > 0)
                    <ul>
                        @foreach($trendingThreadsInCategory as $thread)
                            <li class="mb-2">
                                <a href="{{ route('forum.threads.show', $thread->id) }}" class="text-blue-400 hover:underline">
                                    {{ Str::limit($thread->title, 50) }}
                                </a>
                                <span class="text-sm text-gray-500 ml-2">({{ $thread->posts_count ?? '0' }} bài viết)</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Chưa có chủ đề nổi bật trong chuyên mục này.</p>
                @endif
            </div>

        </x-sidebar>
    @endsection

@endsection