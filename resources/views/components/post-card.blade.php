@props(['post', 'showThreadLink' => false])

<div class="bg-white p-6 shadow-md rounded-lg border border-blue-200 game-card">
    <div class="flex items-center mb-4">
        @if($post->user->avatar)
            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full mr-3 border-2 border-blue-400">
        @else
            <i class="fas fa-user-circle text-3xl mr-3 text-blue-700"></i>
        @endif
        <div>
            <a href="{{ route('profile.show', $post->user) }}" class="text-gray-800 font-semibold hover:text-blue-600">{{ $post->user->name }}</a>
            <p class="text-gray-600 text-sm"><i class="far fa-clock mr-1"></i> Đăng {{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <div class="text-gray-700 text-base leading-relaxed mb-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    @if($showThreadLink)
        <div class="mb-4">
            <p class="text-gray-600 text-sm">Trong chủ đề:
                <a href="{{ route('forum.threads.show', $post->thread) }}" class="text-blue-600 hover:underline">
                    {{ Str::limit($post->thread->title, 60) }}
                </a>
            </p>
        </div>
    @endif

    @auth
        @can('update', $post)
            <div class="mt-4 flex space-x-2">
                <a href="{{ route('forum.posts.edit', $post) }}" class="pixel-btn bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-3">
                    <i class="fas fa-edit mr-1"></i> Sửa
                </a>
                <form action="{{ route('forum.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa bài viết này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pixel-btn bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-3">
                        <i class="fas fa-trash-alt mr-1"></i> Xóa
                    </button>
                </form>
            </div>
        @endcan
    @endauth

    <hr class="border-gray-300 my-4">

    <div class="pl-8 border-l-2 border-gray-300">
        <h4 class="text-md font-semibold text-gray-800 mb-3">Phản hồi:</h4>
        @if($post->replies->isEmpty())
            <p class="text-gray-600 text-sm italic">Chưa có phản hồi nào.</p>
        @else
            <div class="space-y-3">
                @foreach($post->replies as $reply)
                    <x-reply-card :reply="$reply" />
                @endforeach
            </div>
        @endif

        @auth
            @can('create', \App\Models\Reply::class) 
                <div class="mt-4 bg-gray-100 p-4 rounded-lg border border-blue-200">
                    <h5 class="text-base font-semibold text-gray-800 mb-2">Gửi phản hồi:</h5>
                    <form action="{{ route('forum.replies.store', ['post' => $post->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <x-form-textarea id="comment-{{ $post->id }}" name="comment" rows="3"
                                         placeholder="Viết phản hồi của bạn..."
                                         class="bg-white border-gray-300 text-gray-900"></x-form-textarea>
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="flex justify-end mt-2">
                            <x-form-button type="submit" class="pixel-btn bg-blue-600 hover:bg-blue-700 text-xs py-1 px-3"> 
                                Trả lời
                            </x-form-button>
                        </div>
                    </form>
                </div>
            @endcan
        @else
            <p class="text-gray-600 text-xs mt-4 text-center">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đăng nhập</a> để trả lời.
            </p>
        @endauth
    </div>