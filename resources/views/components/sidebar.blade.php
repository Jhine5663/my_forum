{{-- resources/views/components/sidebar.blade.php --}}
@props([
    'categories',
    'userCount',
    'threadCount',
    'postCount',
    'latestThreads', // Biến này có thể không cần nếu trendingTopics đã thay thế
    'recentSidebarActivities' => collect(), // Hoạt động gần đây của tất cả forum users
    'trendingTopics' => collect(), // Chủ đề nổi bật (từ ML hoặc latest/most popular threads)
    'topMembers' => collect(), // Thành viên tích cực (từ ViewComposer)
    // Các biến khác nếu cần cho sự kiện hoặc game nổi bật
])

<div class="space-y-6"> {{-- Khoảng cách giữa các widget --}}

    {{-- Widget Danh mục --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-tags mr-2 text-blue-600"></i> Danh mục
        </h3>
        @if ($categories->isEmpty())
            <p class="text-gray-600 text-sm">Chưa có danh mục nào.</p>
        @else
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('forum.categories.show', $category) }}"
                            class="text-blue-600 hover:underline flex items-center justify-between py-1">
                            <span class="flex items-center"><i class="fas fa-folder mr-2 text-blue-600"></i>
                                {{ $category->name }}</span>
                            <span
                                class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">{{ $category->threads_count ?? $category->threads->count() }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('forum.index') }}"
            class="w-full text-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-3 block">
            Xem tất cả danh mục
        </a>
    </div>

    {{-- Widget Hoạt động gần đây (Threads, Posts, Replies mới nhất) --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-history mr-2 text-green-600"></i> Hoạt động gần đây
        </h3>
        @if ($recentSidebarActivities->isEmpty())
            <p class="text-gray-600 text-sm italic">Chưa có hoạt động gần đây nào.</p>
        @else
            <ul class="space-y-3">
                @foreach ($recentSidebarActivities as $activity)
                    <li class="flex items-start space-x-2">
                        <div
                            class="p-1 rounded-full {{ $activity->type === 'thread' ? 'bg-blue-100 text-blue-600' : ($activity->type === 'post' ? 'bg-green-100 text-green-600' : 'bg-purple-100 text-purple-600') }}">
                            <i
                                class="{{ $activity->type === 'thread' ? 'fas fa-comments' : ($activity->type === 'post' ? 'fas fa-file-alt' : 'fas fa-reply') }} text-sm"></i>
                        </div>
                        <p class="text-gray-700 text-sm flex-1">
                            @if ($activity->type === 'thread')
                                Chủ đề: <a href="{{ route('forum.threads.show', $activity->id) }}"
                                    class="text-blue-600 hover:underline">{{ Str::limit($activity->title, 40) }}</a>
                            @elseif($activity->type === 'post')
                                Bài viết: <a
                                    href="{{ route('forum.threads.show', $activity->thread_id) }}#post-{{ $activity->id }}"
                                    class="text-blue-600 hover:underline">{{ Str::limit($activity->content, 40) }}</a>
                            @else
                                {{-- reply --}}
                                Phản hồi: <a
                                    href="{{ route('forum.threads.show', $activity->post->thread_id) }}#post-{{ $activity->post_id }}"
                                    class="text-blue-600 hover:underline">{{ Str::limit($activity->comment, 40) }}</a>
                            @endif
                            <span
                                class="text-gray-500 text-xs ml-1">({{ $activity->created_at?->diffForHumans() }})</span>
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('forum.threads.index') }}"
            class="w-full text-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-3 block">
            Xem tất cả hoạt động
        </a>
    </div>

    {{-- Widget Chủ đề nổi bật (từ ML hoặc dữ liệu phổ biến) --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-fire mr-2 text-red-600"></i> Chủ đề nổi bật
        </h3>
        @if ($trendingTopics->isEmpty())
            <p class="text-gray-600 text-sm italic">Chưa có chủ đề nổi bật nào.</p>
        @else
            <ul class="space-y-3">
                @foreach ($trendingTopics as $topic)
                    <li class="flex items-center space-x-2">
                        {{-- Icon cho từng loại trending (ví dụ: hot, mới, có giải pháp) --}}
                        <i class="fas fa-arrow-alt-circle-up text-red-500"></i> {{-- Ví dụ icon phổ biến --}}
                        <a href="{{ route('forum.threads.show', $topic->id) }}"
                            class="text-blue-600 hover:underline text-sm font-medium">
                            {{ Str::limit($topic->title, 50) }}
                        </a>
                        {{-- Có thể hiển thị lượt xem, lượt bình luận --}}
                        <span class="ml-auto text-gray-500 text-xs">{{ $topic->posts_count ?? $topic->posts->count() }}
                            bài</span>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('forum.threads.index') }}"
            class="w-full text-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-3 block">
            Xem thêm chủ đề
        </a>
    </div>

    {{-- Widget Thành viên tích cực --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-trophy mr-2 text-yellow-600"></i> Thành viên tích cực
        </h3>
        @if ($topMembers->isEmpty())
            <p class="text-gray-600 text-sm italic">Chưa có thành viên tích cực nào.</p>
        @else
            <div class="space-y-3">
                @foreach ($topMembers as $member)
                    <div class="flex items-center">
                        {{-- Avatar --}}
                        @if ($member->avatar)
                            <img src="{{ asset('storage/' . $member->avatar) }}" alt="{{ $member->user_name }}"
                                class="w-10 h-10 rounded-full mr-3 object-cover border-2 border-blue-300">
                        @else
                            <div
                                class="w-10 h-10 rounded-full mr-3 bg-blue-100 flex items-center justify-center text-blue-600 border-2 border-blue-300">
                                <span class="text-sm font-bold">{{ Str::limit($member->user_name, 2, '') }}</span>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $member->user_name }}</h4>
                            <div class="flex items-center text-sm text-gray-600">
                                <i
                                    class="fas fa-medal mr-1 
                                    @if ($loop->first) text-yellow-500
                                    @elseif($loop->iteration == 2) text-gray-400
                                    @elseif($loop->iteration == 3) text-amber-600
                                    @else text-blue-500 @endif
                                "></i>
                                <span>{{ $member->posts_count ?? 0 }} bài viết</span>
                            </div>
                        </div>
                        <a href="{{ route('users.profile', $member->id) }}"
                            class="ml-auto text-blue-600 hover:text-blue-800 text-sm">Xem</a> {{-- Link đến profile công khai --}}
                    </div>
                @endforeach
            </div>
        @endif
        <a class="w-full text-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-3 block">
            Xem bảng xếp hạng
        </a>
    </div>

    {{-- Widget Thống kê (tổng) --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-chart-bar mr-2 text-purple-600"></i> Thống kê chung
        </h3>
        <p class="text-gray-700 text-sm mb-2">Người dùng: <span class="font-semibold">{{ $userCount }}</span></p>
        <p class="text-gray-700 text-sm mb-2">Chủ đề: <span class="font-semibold">{{ $threadCount }}</span></p>
        <p class="text-gray-700 text-sm">Bài viết: <span class="font-semibold">{{ $postCount }}</span></p>
    </div>

    {{-- Widget Sự kiện sắp tới (đang là tĩnh, có thể làm động sau) --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-calendar-alt mr-2 text-orange-600"></i> Sự kiện sắp tới
        </h3>
        <div class="space-y-3">
            {{-- Dữ liệu mẫu --}}
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
            <button class="w-full text-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-2">
                Xem tất cả sự kiện
            </button>
        </div>
    </div>

    {{-- Widget Game nổi bật (đang là tĩnh) --}}
    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-200">
        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
            <i class="fas fa-gamepad mr-2 text-yellow-600"></i> Game nổi bật
        </h3>
        <ul class="space-y-2">
            <li><a href="#" class="text-blue-600 hover:underline">Hollow Knight</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">Celeste</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">Stardew Valley</a></li>
        </ul>
    </div>

    {{ $slot ?? '' }} {{-- Dùng $slot để render nội dung được truyền vào component --}}
</div>
