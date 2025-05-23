<div class="space-y-4">
    <div>
        <h3 class="font-bold text-lg mb-4 text-white pixel-font text-blue-400 glow-text">Danh mục</h3>
        @if($categories->isEmpty())
            <p class="text-gray-500">Chưa có danh mục.</p>
        @else
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('forum.categories.show', $category) }}" class="text-blue-400 hover:underline flex items-center">
                            <i class="fas fa-folder mr-2"></i> {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div>
        <h3 class="font-bold text-lg mb-4 text-white pixel-font text-blue-400 glow-text">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach(['RPG', 'Platformer', 'Pixel Art', 'Retro', 'Multiplayer'] as $tag)
                <span class="bg-gray-700 text-white px-2 py-1 rounded text-sm hover:bg-blue-500">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
    <div>
        <h3 class="font-bold text-lg mb-4 text-white pixel-font text-blue-400 glow-text">Thống kê</h3>
        <p class="text-gray-300">Người dùng: {{ $userCount }}</p>
        <p class="text-gray-300">Chủ đề: {{ $threadCount }}</p>
        <p class="text-gray-300">Bài viết: {{ $postCount }}</p>
    </div>
    <div>
        <h3 class="font-bold text-lg mb-4 text-white pixel-font text-blue-400 glow-text">Game nổi bật</h3>
        <ul class="space-y-2">
            <li><a href="#" class="text-blue-400 hover:underline">Hollow Knight</a></li>
            <li><a href="#" class="text-blue-400 hover:underline">Celeste</a></li>
            <li><a href="#" class="text-blue-400 hover:underline">Stardew Valley</a></li>
        </ul>
    </div>
</div>