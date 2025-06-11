@extends('layouts.forum')

@section('title', 'Trang Chủ | Game 2D Forum - Diễn đàn game 2D')
@section('meta_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')

@section('forum-content')
    <section class="bg-gradient-to-r from-blue-800 to-purple-800 rounded-xl p-6 md:p-10 text-white mb-8">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-6 md:mb-0">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Cộng đồng game 2D lớn nhất</h2>
                <p class="text-lg mb-6">Thảo luận, chia sẻ và kết nối với những người đam mê game 2D. Từ indie đến AAA, từ pixel art đến vector graphics.</p>
                <div class="flex space-x-4">
                    <a href="{{ route('register') }}" class="bg-white text-blue-800 hover:bg-gray-200 px-6 py-2 rounded-full font-medium">Tham gia ngay</a>
                    <a href="{{ route('forum.threads.index') }}" class="border border-white hover:bg-white hover:text-blue-800 px-6 py-2 rounded-full font-medium">Tìm hiểu thêm</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('storage/images/forum-banner.png') }}" alt="Game 2D" class="rounded-lg shadow-xl w-full max-w-md">
            </div>
        </div>
    </section>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button role="tab" class="btn-pixel py-4 px-6 text-center border-b-2 font-medium text-sm active-tab">
                    <i class="fas fa-comments mr-2"></i>Thảo luận mới
                </button>
                <button role="tab" class="btn-pixel py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-fire mr-2"></i>Phổ biến
                </button>
                <button role="tab" class="btn-pixel py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-check-circle mr-2"></i>Đã giải quyết
                </button>
                <button role="tab" class="btn-pixel py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-star mr-2"></i>Đề xuất
                </button>
            </nav>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
        <div class="flex items-center w-full">
            @auth
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->user_name }}" class="rounded-full w-10 h-10 mr-3">
                @else
                    <i class="fas fa-user-circle text-2xl mr-3 text-blue-500"></i>
                @endif
                <input type="text" onclick="window.location.href='{{ route('forum.threads.create') }}'"
                    placeholder="Bạn muốn thảo luận điều gì?"
                    class="bg-gray-100 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
            @else
                <i class="fas fa-user-circle text-2xl mr-3 text-gray-400"></i>
                <input type="text" onclick="window.location.href='{{ route('login') }}'"
                    placeholder="Đăng nhập để bắt đầu thảo luận!"
                    class="bg-gray-100 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
            @endauth
        </div>
        @auth
            <button onclick="window.location.href='{{ route('forum.threads.create') }}'" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full ml-2 btn-pixel">
                <i class="fas fa-paper-plane mr-2"></i>
            </button>
        @endauth
    </div>

    <div class="space-y-4">
        @if ($categories->isNotEmpty()) 
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
                        <a href="{{ route('forum.categories.show', $category) }}" class="text-sm text-blue-600 hover:underline btn-pixel bg-gray-100 px-3 py-1 rounded">
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
        @else
            <p class="text-gray-700 text-center text-lg mt-8">Chưa có chuyên mục nào được tạo. Vui lòng quay lại sau.</p>
        @endif

        <div class="text-center mt-6">
            <button id="load-more-posts" class="bg-white hover:bg-gray-100 text-blue-500 font-medium py-2 px-6 rounded-full border border-gray-300 shadow-sm">
                <i class="fas fa-sync-alt mr-2"></i>Tải thêm chủ đề
            </button>
        </div>
    </div>
@endsection
