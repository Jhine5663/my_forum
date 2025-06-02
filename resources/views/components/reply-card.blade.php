{{-- resources/views/components/reply-card.blade.php --}}
@props(['reply', 'showPostLink' => false])

<div class="bg-gray-700 p-4 rounded-lg border border-blue-600/30">
    <div class="flex items-center mb-2">
        @if($reply->user->avatar)
            <img src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full mr-2 border-2 border-blue-300">
        @else
            <i class="fas fa-user-circle text-xl mr-2 text-blue-300"></i>
        @endif
        <div>
            <a href="{{ route('profile.show', $reply->user) }}" class="text-white font-medium hover:text-blue-300">{{ $reply->user->name }}</a>
            <p class="text-gray-400 text-xs"><i class="far fa-clock mr-1"></i> Phản hồi {{ $reply->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <div class="text-gray-300 text-sm leading-snug mb-3">
        {!! nl2br(e($reply->comment)) !!}
    </div>

    @if($showPostLink && $reply->post)
        <div class="text-gray-400 text-xs">
            Phản hồi bài viết:
            <a href="{{ route('forum.threads.show', $reply->post->thread) }}#post-{{ $reply->post->id }}" class="text-blue-400 hover:underline">
                {{ Str::limit($reply->post->content, 50) }}
            </a>
        </div>
    @endif

    {{-- Nút hành động cho Reply (Sửa/Xóa) --}}
    @auth
        @can('update', $reply)
            <div class="mt-3 flex space-x-2 text-right justify-end">
                <a href="{{ route('forum.replies.edit', $reply) }}" class="pixel-btn bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-2">
                    <i class="fas fa-edit mr-1"></i> Sửa
                </a>
                <form action="{{ route('forum.replies.destroy', $reply) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa phản hồi này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pixel-btn bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-2">
                        <i class="fas fa-trash-alt mr-1"></i> Xóa
                    </button>
                </form>
            </div>
        @endcan
    @endauth
</div>