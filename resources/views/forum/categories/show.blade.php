@extends('layouts.forum')

@section('meta_description', 'Các chủ đề thảo luận về ' . $category->name . ' trong diễn đàn game 2D.')
@section('meta_keywords', '{{ $category->name }}, game 2D, indie game, lập trình game, {{ $category->name }} threads')
@section('og_title', 'Chuyên mục: ' . $category->name . ' | Diễn đàn Game 2D')
@section('og_description', 'Khám phá các chủ đề và thảo luận sôi nổi trong chuyên mục ' . $category->name . ' của diễn đàn game 2D.')
@section('og_image', asset($category->image_url ?? 'images/default_category_og_image.png'))

@section('forum-content')
    <div class="flex-1 p-6">
        {{-- Breadcrumbs --}}
        <nav class="text-sm font-semibold mb-4 flex items-center space-x-2 text-gray-600">
            <a href="{{ route('forum.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-home"></i> Diễn đàn
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ $category->name }}</span> {{-- Màu chữ đậm --}}
        </nav>

        {{-- Khối thông tin Chuyên mục --}}
        <div class="bg-white p-6 mb-6 shadow-xl rounded-lg border border-gray-200 game-card"> {{-- Nền trắng, viền xám nhạt --}}
            {{-- Đã loại bỏ pixel-font khỏi tên chuyên mục để phù hợp tiếng Việt --}}
            <h1 class="text-3xl font-bold text-gray-800 glow-text mb-2">
                {{ $category->name }}
            </h1>
            <p class="text-gray-700 text-base mb-4"> {{-- Màu chữ đậm hơn --}}
                {{ $category->description ?? 'Nơi thảo luận các chủ đề liên quan đến ' . $category->name . '.' }}
            </p>
            <div class="text-sm text-gray-600"> {{-- Màu chữ xám đậm --}}
                <span class="mr-4"><i class="fas fa-comments"></i> Tổng số chủ đề: {{ $category->threads_count ?? $category->threads->count() }}</span>
            </div>

            @auth
                <div class="mt-4">
                    {{-- Nút "Tạo chủ đề mới" với btn-pixel --}}
                    <a href="{{ route('forum.threads.create', ['category_id' => $category->id]) }}"
                       class="btn-pixel bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 w-fit"> {{-- Đã dùng btn-pixel --}}
                        <i class="fas fa-plus-circle"></i>
                        <span>Tạo chủ đề mới trong {{ $category->name }}</span>
                    </a>
                </div>
            @else
                <p class="text-gray-600 text-sm mt-4">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đăng nhập</a> để tạo chủ đề mới.
                </p>
            @endauth
        </div>

        {{-- Tiêu đề "Các chủ đề trong chuyên mục này" --}}
        <h2 class="text-xl font-bold text-gray-800 glow-text mb-4 border-b border-gray-200 pb-2"> {{-- Màu chữ đậm, viền nhạt --}}
            Các chủ đề trong chuyên mục này
        </h2>

        @if ($threads->isEmpty())
            <div class="bg-white p-4 mb-4 shadow-md rounded-lg border border-gray-200">
                <p class="text-gray-600 text-center">Chưa có chủ đề nào trong chuyên mục này. Hãy là người đầu tiên tạo một chủ đề!</p>
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

    @section('sidebar_specific_content') {{-- Đây là section riêng cho nội dung sidebar --}}
        {{-- Widget Chủ đề Nổi bật từ chuyên mục --}}
        <div class="bg-white p-4 rounded-lg shadow-md mb-4 border border-blue-200"> {{-- Nền trắng, viền xanh nhạt --}}
            <h3 class="font-bold text-lg mb-3 text-gray-800 flex items-center"> {{-- Màu chữ đậm --}}
                <i class="fas fa-fire mr-2 text-red-600"></i> Chủ đề Nổi bật từ {{ $category->name }}
            </h3>
            @if(!empty($trendingThreadsInCategory) && $trendingThreadsInCategory->count() > 0)
                <ul class="space-y-2">
                    @foreach($trendingThreadsInCategory as $thread)
                        <li>
                            <a href="{{ route('forum.threads.show', $thread->id) }}" class="text-blue-600 hover:underline text-sm font-medium">
                                {{ Str::limit($thread->title, 50) }}
                            </a>
                            <span class="text-gray-500 text-xs ml-2">({{ $thread->posts_count ?? '0' }} bài viết)</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 text-sm italic">Chưa có chủ đề nổi bật trong chuyên mục này.</p>
            @endif
        </div>
    @endsection

@endsection