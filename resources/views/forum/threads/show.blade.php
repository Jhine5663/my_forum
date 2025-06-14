@extends('layouts.forum')

@section('title', $thread->title . ' | Game 2D Forum - Diễn đàn game 2D')
@section('meta_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))
@section('og_title', $thread->title)
@section('og_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))

@section('forum-content')
    <div class="flex-1 p-6">
        {{-- Breadcrumbs --}}
        <nav class="text-sm font-semibold mb-4 flex items-center space-x-2 text-gray-600">
            <a href="{{ route('forum.index') }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-home"></i> Diễn đàn</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('forum.categories.show', $thread->category) }}" class="text-blue-600 hover:text-blue-800">{{ $thread->category->name }}</a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ Str::limit($thread->title, 50) }}</span>
        </nav>

        {{-- Hộp thông tin chủ đề --}}
        <div class="bg-white p-6 mb-6 shadow-xl rounded-lg border border-gray-200">
            <h1 class="text-3xl font-bold text-gray-800 glow-text mb-3">
                {{ $thread->title }}
            </h1>
            <div class="flex items-center text-gray-600 text-sm mb-4 space-x-4">
                <div class="flex items-center">
                    @if($thread->user->avatar)
                        <img src="{{ asset('storage/' . $thread->user->avatar) }}" alt="{{ $thread->user->user_name }}" class="w-8 h-8 rounded-full mr-2 border-2 avatar-border">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($thread->user->user_name) }}&background=090979&color=FFFFFF&size=32&bold=true"
                             alt="{{ $thread->user->user_name }}"
                             class="w-8 h-8 rounded-full mr-2 object-cover border-2 avatar-border">
                    @endif
                    <span>Đăng bởi <a href="{{ route('users.profile', $thread->user) }}" class="text-blue-600 hover:underline font-medium">{{ $thread->user->user_name }}</a></span>
                </div>
                <span><i class="far fa-clock mr-1"></i> {{ $thread->created_at->diffForHumans() }}</span>
                <span><i class="fas fa-folder-open mr-1"></i> <a href="{{ route('forum.categories.show', $thread->category) }}" class="text-blue-600 hover:underline">{{ $thread->category->name }}</a></span>
            </div>
            @auth
                @can('update', $thread)
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('forum.threads.edit', $thread) }}" class="btn-pixel bg-yellow-500 hover:bg-yellow-600 text-white text-sm">
                            <i class="fas fa-edit mr-1"></i> Sửa chủ đề
                        </a>
                        <form action="{{ route('forum.threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa chủ đề này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-pixel bg-red-500 hover:bg-red-600 text-white text-sm">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa chủ đề
                            </button>
                        </form>
                    </div>
                @endcan
            @endauth
        </div>

        {{-- === PHẦN HIỂN THỊ POST VÀ REPLY ĐÃ ĐƯỢC SỬA LẠI === --}}
        <h2 class="text-xl font-bold text-gray-800 glow-text mb-4 border-b border-gray-200 pb-2">
            Các bài viết và phản hồi
        </h2>

        @if ($posts->isEmpty())
            <p class="text-gray-600 text-center">Chưa có bài viết nào trong chủ đề này.</p>
        @else
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <div id="post-{{ $post->id }}">
                        {{-- 1. Hiển thị card cho bài viết chính --}}
                        <x-post-card :post="$post" />

                        {{-- 2. Hiển thị các phản hồi cho bài viết đó --}}
                        @if($post->replies->isNotEmpty())
                            <div class="ml-8 mt-4 space-y-4 border-l-2 border-gray-200 pl-8">
                                @foreach($post->replies as $reply)
                                    <x-reply-card :reply="$reply" />
                                @endforeach
                            </div>
                        @endif

                        {{-- 3. Form để trả lời cho bài viết này --}}
                        @auth
                            @can('create', \App\Models\Reply::class)
                                <div class="ml-8 mt-4 pl-8">
                                    <form action="{{ route('forum.replies.store', ['post' => $post->id]) }}" method="POST" class="bg-gray-50 p-4 rounded-lg border">
                                        @csrf
                                        <h5 class="text-base font-semibold text-gray-700 mb-2">Gửi phản hồi của bạn:</h5>
                                        <x-form-textarea id="comment-{{ $post->id }}" name="comment" rows="2" placeholder="Viết phản hồi..." class="bg-white"></x-form-textarea>
                                        @error('comment')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                        <div class="flex justify-end mt-2">
                                            <x-form-button type="submit" class="btn-pixel bg-blue-600 hover:bg-blue-700 text-white text-sm">Trả lời</x-form-button>
                                        </div>
                                    </form>
                                </div>
                            @endcan
                        @endauth
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
        {{-- === KẾT THÚC PHẦN SỬA LẠI === --}}

        {{-- Phần gợi ý bài viết liên quan (giữ nguyên) --}}
        @if($recommendedPosts->isNotEmpty())
            <div class="mt-8 p-6 bg-white shadow-xl rounded-lg border border-gray-200 game-card">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Bài viết liên quan từ Omnisiah</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($recommendedPosts as $recPost)
                        <x-suggestion :item="$recPost" type="post" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection