@props(['post'])

<div class="bg-white p-6 shadow-md rounded-lg border border-blue-200 game-card">
    {{-- Phần thông tin người dùng và thời gian --}}
    <div class="flex items-start mb-4">
        @if($post->user->avatar)
            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->user_name }}" class="w-10 h-10 rounded-full mr-3 border-2 border-blue-400">
        @else
             <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->user_name) }}&background=090979&color=FFFFFF&size=40&bold=true"
                 alt="{{ $post->user->user_name }}"
                 class="w-10 h-10 rounded-full mr-3 object-cover border-2 border-blue-400">
        @endif
        <div class="flex-1">
            <a href="{{ route('users.profile', $post->user) }}" class="text-gray-800 font-semibold hover:text-blue-600">{{ $post->user->user_name }}</a>
            <p class="text-gray-600 text-sm"><i class="far fa-clock mr-1"></i> Đăng {{ $post->created_at->diffForHumans() }}</p>
        </div>
         {{-- Nút sửa/xóa cho bài viết --}}
        @auth
            @can('update', $post)
                <div class="flex space-x-2">
                    <a href="{{ route('forum.posts.edit', $post) }}" class="btn-pixel bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('forum.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-pixel bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            @endcan
        @endauth
    </div>

    {{-- Phần nội dung chính của bài viết --}}
    <div class="text-gray-700 text-base leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>
</div>