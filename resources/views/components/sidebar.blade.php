@props(['categories', 'userCount', 'threadCount', 'postCount', 'latestThreads'])

<div class="space-y-4">
    <div>
        {{-- Đã loại bỏ pixel-font khỏi tiêu đề con --}}
        {{-- <h3 class="font-bold text-lg mb-4 text-blue-800">Chuyên mục</h3> --}}
        @if($categories->isEmpty())
            <p class="text-gray-600">Chưa có chuyên mục.</p>
        @else
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('forum.categories.show', $category) }}" class="text-blue-700 hover:underline flex items-center">
                            <i class="fas fa-folder mr-2 text-blue-700"></i> {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div>
        {{-- Đã loại bỏ pixel-font khỏi tiêu đề con --}}
        <h3 class="font-bold text-lg mb-4 text-blue-800">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach(['RPG', 'Platformer', 'Pixel Art', 'Retro', 'Multiplayer'] as $tag)
                <span class="bg-blue-200 text-blue-900 px-2 py-1 rounded text-sm hover:bg-blue-300 transition-colors">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
    <div>
        {{-- Đã loại bỏ pixel-font khỏi tiêu đề con --}}
        <h3 class="font-bold text-lg mb-4 text-blue-800">Thống kê</h3>
        <p class="text-gray-800">Người dùng: {{ $userCount }}</p>
        <p class="text-gray-800">Chủ đề: {{ $threadCount }}</p>
        <p class="text-gray-800">Bài viết: {{ $postCount }}</p>
    </div>
    <div>
        {{-- Đã loại bỏ pixel-font khỏi tiêu đề con --}}
        <h3 class="font-bold text-lg mb-4 text-blue-800">Game nổi bật</h3>
        <ul class="space-y-2">
            <li><a href="#" class="text-blue-700 hover:underline">Hollow Knight</a></li>
            <li><a href="#" class="text-blue-700 hover:underline">Celeste</a></li>
            <li><a href="#" class="text-blue-700 hover:underline">Stardew Valley</a></li>
        </ul>
    </div>
    {{ $slot ?? '' }}
</div>