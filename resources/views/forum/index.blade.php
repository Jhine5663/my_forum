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
                <img src="https://via.placeholder.com/500x300/e0f2fe/1e3c72?text=2D+Game+Hub" alt="Game 2D" class="rounded-lg shadow-xl w-full max-w-md">
            </div>
        </div>
    </section>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button role="tab" class="py-4 px-6 text-center border-b-2 font-medium text-sm active-tab">
                    <i class="fas fa-comments mr-2"></i>Thảo luận mới
                </button>
                <button role="tab" class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-fire mr-2"></i>Phổ biến
                </button>
                <button role="tab" class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-check-circle mr-2"></i>Đã giải quyết
                </button>
                <button role="tab" class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
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
            <button onclick="window.location.href='{{ route('forum.threads.create') }}'" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full ml-2">
                <i class="fas fa-paper-plane mr-2"></i>Đăng
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

@section('sidebar_specific_content') 

    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold text-lg mb-4 flex items-center">
            <i class="fas fa-tags mr-2 text-blue-500"></i> Danh mục
        </h3>
        <div class="space-y-2">
            @foreach($categories as $category)
                <a href="{{ route('forum.categories.show', $category) }}" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-100">
                    <span>{{ $category->name }}</span>
                    <span class="bg-gray-200 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">{{ $category->threads_count ?? $category->threads->count() }}</span>
                </a>
            @endforeach
            <a href="{{ route('forum.index') }}" class="w-full text-center text-blue-500 hover:text-blue-700 text-sm font-medium mt-2 block"> {{-- Link "Xem tất cả danh mục" trỏ về trang chủ hoặc trang categories.index nếu có --}}
                Xem tất cả danh mục
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold text-lg mb-4 flex items-center">
            <i class="fas fa-fire mr-2 text-red-500"></i> Game phổ biến
        </h3>
        <div class="space-y-4">
            <div class="flex items-center">
                <img src="https://via.placeholder.com/50/e0f2fe/1e3c72?text=Celeste" alt="Game" class="w-12 h-12 rounded-lg mr-3">
                <div>
                    <h4 class="font-medium">Celeste</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9
                        <span class="mx-2">•</span>
                        <span>Platformer</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <img src="https://via.placeholder.com/50/e0f2fe/1e3c72?text=Stardew" alt="Game" class="w-12 h-12 rounded-lg mr-3">
                <div>
                    <h4 class="font-medium">Stardew Valley</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.8
                        <span class="mx-2">•</span>
                        <span>Farming Sim</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <img src="https://via.placeholder.com/50/e0f2fe/1e3c72?text=Hollow" alt="Game" class="w-12 h-12 rounded-lg mr-3">
                <div>
                    <h4 class="font-medium">Hollow Knight</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9
                        <span class="mx-2">•</span>
                        <span>Metroidvania</span>
                    </div>
                </div>
            </div>
            <button class="w-full text-center text-blue-500 hover:text-blue-700 text-sm font-medium mt-2">
                Xem thêm game
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold text-lg mb-4 flex items-center">
            <i class="fas fa-trophy mr-2 text-yellow-500"></i> Thành viên tích cực
        </h3>
        <div class="space-y-3">
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40/e0f2fe/1e3c72?text=User1" alt="User" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <h4 class="font-medium">GameMaster</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-medal text-blue-500 mr-1"></i> 1,245 bài
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40/e0f2fe/1e3c72?text=User2" alt="User" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <h4 class="font-medium">PixelQueen</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-medal text-purple-500 mr-1"></i> 892 bài
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40/e0f2fe/1e3c72?text=User3" alt="User" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <h4 class="font-medium">CodeNinja</h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-medal text-green-500 mr-1"></i> 756 bài
                    </div>
                </div>
            </div>
            <button class="w-full text-center text-blue-500 hover:text-blue-700 text-sm font-medium mt-2">
                Xem bảng xếp hạng
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold text-lg mb-4 flex items-center">
            <i class="fas fa-calendar-alt mr-2 text-green-500"></i> Sự kiện sắp tới
        </h3>
        <div class="space-y-3">
            <div class="p-3 bg-blue-50 rounded-lg">
                <div class="flex items-start">
                    <div class="bg-blue-100 text-blue-800 rounded-lg p-2 mr-3">
                        <div class="text-sm font-bold">15</div>
                        <div class="text-xs">TH6</div>
                    </div>
                    <div>
                        <h4 class="font-medium text-sm">Game Jam 2D</h4>
                        <p class="text-xs text-gray-600">Cuộc thi phát triển game 2D trong 48h</p>
                    </div>
                </div>
            </div>
            <div class="p-3 bg-purple-50 rounded-lg">
                <div class="flex items-start">
                    <div class="bg-purple-100 text-purple-800 rounded-lg p-2 mr-3">
                        <div class="text-sm font-bold">22</div>
                        <div class="text-xs">TH6</div>
                    </div>
                    <div>
                        <h4 class="font-medium text-sm">Workshop Pixel Art</h4>
                        <p class="text-xs text-gray-600">Hướng dẫn tạo nhân vật pixel art</p>
                    </div>
                </div>
            </div>
            <button class="w-full text-center text-blue-500 hover:text-blue-700 text-sm font-medium mt-2">
                Xem tất cả sự kiện
            </button>
        </div>
    </div>
@endsection

@push('scripts') 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        const backToTopButton = document.getElementById('back-to-top');
        
        if (backToTopButton) {
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('hidden');
                } else {
                    backToTopButton.classList.add('hidden');
                }
            });
            
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        const tabs = document.querySelectorAll('[role="tab"]');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('active-tab');
                    t.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    t.classList.remove('text-blue-500'); 
                    t.style.borderBottomColor = ''; 
                });
                
                tab.classList.add('active-tab');
                tab.classList.remove('text-gray-500');
                tab.classList.add('text-blue-500'); 
                tab.style.borderBottomColor = '#4299e1'; 
            });
        });

        const loadMoreButton = document.getElementById('load-more-posts'); 
        
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', () => {
                loadMoreButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang tải...';
                
                setTimeout(() => {
                    alert('Đã tải thêm bài viết mới!');
                    loadMoreButton.innerHTML = '<i class="fas fa-sync-alt mr-2"></i>Tải thêm chủ đề'; 
                }, 1500);
            });
        }
    });
</script>
@endpush