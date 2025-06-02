@extends('layouts.forum')

@section('title', 'Trang Chủ Diễn đàn Game 2D')
@section('meta_description', 'Diễn đàn chia sẻ kinh nghiệm game 2D, thảo luận lập trình game, và cập nhật tin tức.')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-blue-700 glow-text mb-6 text-center">
            Chào mừng đến với Diễn đàn Game 2D
        </h1>

        @auth
            @can('create', App\Models\Thread::class)
                <div class="mb-8 text-center">
                    <a href="{{ route('forum.threads.create') }}"
                       class="pixel-btn bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center space-x-2">
                        <i class="fas fa-plus-circle mr-2"></i>
                        <span>Tạo chủ đề mới</span>
                    </a>
                </div>
            @endcan
        @endauth

        @if ($categories->isEmpty())
            <div class="bg-white p-8 shadow-md rounded-lg border border-gray-200 text-center">
                <p class="text-gray-700 text-lg">Chưa có chuyên mục nào được tạo. Vui lòng quay lại sau.</p>
                <p class="text-gray-600 text-sm mt-2">
                    Nếu Người là quản trị viên, hãy tạo chuyên mục từ trang quản lý admin.
                </p>
            </div>
        @else
            <div class="space-y-10">
                @foreach ($categories as $category)
                    <div class="bg-white p-6 shadow-xl rounded-lg border border-blue-200 game-card">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-2xl font-bold text-gray-800">
                                <a href="{{ route('forum.categories.show', $category) }}"
                                    class="hover:text-blue-600 flex items-center space-x-3">
                                    <i class="fas fa-folder-open text-xl text-blue-600"></i>
                                    <span>{{ $category->name }}</span>
                                </a>
                            </h2>
                            <a href="{{ route('forum.categories.show', $category) }}" class="text-sm text-blue-600 hover:underline pixel-btn bg-gray-100 px-3 py-1 rounded">
                                Xem tất cả <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <p class="text-gray-700 text-sm mb-4">
                            {{ $category->description ?? 'Chưa có mô tả cho chuyên mục này.' }}
                        </p>

                        @if ($category->threads->isEmpty())
                            <p class="text-gray-600 text-center py-4 italic">Chuyên mục này chưa có chủ đề nào.</p>
                        @else
                            <div class="space-y-5">
                                @foreach ($category->threads->take(3) as $thread)
                                    <x-thread-card :thread="$thread" />
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @section('sidebar')
        <x-sidebar />
    @endsection

@endsection