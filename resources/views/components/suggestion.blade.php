@props(['item', 'type' => 'thread'])
{{-- 
    Component này được dùng để hiển thị một mục gợi ý DUY NHẤT.
    Nó nhận vào một đối tượng ($item) và loại của nó ($type) để hiển thị cho đúng.
--}}

<div class="bg-gray-800 p-4 rounded-lg shadow-lg border border-blue-500/30 hover:border-blue-500 transition-all duration-300 h-full flex flex-col">
    @if ($item)
        @if ($type === 'thread')
            <a href="{{ route('forum.threads.show', $item) }}" class="block flex-grow">
                <h4 class="text-md font-semibold text-white hover:text-blue-300">{{ $item->title }}</h4>
                <p class="text-gray-400 text-sm mt-1">
                    bởi {{ $item->user->name }} &bull; {{ $item->created_at->diffForHumans() }}
                </p>
            </a>
        @elseif ($type === 'post')
            {{-- Gợi ý là một bài viết, sẽ link đến chủ đề chứa nó và nhảy đến bài viết đó --}}
            <a href="{{ route('forum.threads.show', $item->thread) }}#post-{{ $item->id }}" class="block flex-grow">
                {{-- Hiển thị một đoạn nội dung của bài viết --}}
                <p class="text-gray-300 mb-2">"{{ Str::limit($item->content, 80) }}"</p>
                <p class="text-sm text-gray-400 mt-1">
                    Trong chủ đề: <span class="font-medium text-gray-200">{{ $item->thread->title }}</span>
                </p>
            </a>
        @endif
    @else
        {{-- Fallback nếu không có item nào được truyền vào --}}
        <p class="text-gray-500">Không có gợi ý.</p>
    @endif
</div>