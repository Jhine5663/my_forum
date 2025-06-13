@extends('layouts.forum')

@section('title', $thread->title . ' | 2D Game Hub - Diễn đàn game 2D')
@section('meta_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))
@section('og_title', $thread->title)
@section('og_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))
{{-- @section('og_image', asset($thread->user->avatar_url ?? 'images/default_user_avatar.png')) --}}

@section('forum-content')
    <div class="flex-1 p-6">
        <nav class="text-sm font-semibold mb-4 flex items-center space-x-2 text-gray-600"> {{-- Màu chữ xám đậm --}}
            <a href="{{ route('forum.index') }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-home"></i> Diễn đàn</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('forum.categories.show', $thread->category) }}" class="text-blue-600 hover:text-blue-800">{{ $thread->category->name }}</a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ Str::limit($thread->title, 50) }}</span> 
        </nav>

        <div class="bg-white p-6 mb-6 shadow-xl rounded-lg border border-gray-200 game-card"> 
            <h1 class="text-3xl font-bold text-gray-800 glow-text mb-3">
                {{ $thread->title }}
            </h1>
            <div class="flex items-center text-gray-600 text-sm mb-4 space-x-4"> 
                <div class="flex items-center">
                    @if($thread->user->avatar)
                        <img src="{{ asset('storage/' . $thread->user->avatar) }}" alt="{{ $thread->user->user_name }}" class="w-8 h-8 rounded-full mr-2 border-2 avatar-border"> {{-- Viền avatar đồng bộ --}}
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($thread->user->user_name) }}&background=090979&color=FFFFFF&size=32&bold=true" {{-- Placeholder màu xanh tím đậm --}}
                                     alt="{{ $thread->user->user_name }}"
                                     class="w-8 h-8 rounded-full mr-2 object-cover border-2 avatar-border">
                    @endif
                    <span>Đăng bởi <a href="{{ route('users.profile', $thread->user) }}" class="text-blue-600 hover:underline font-medium">{{ $thread->user->user_name }}</a></span>
                </div>
                <span><i class="far fa-clock mr-1"></i> {{ $thread->created_at->diffForHumans() }}</span>
                <span><i class="fas fa-folder-open mr-1"></i> <a href="{{ route('forum.categories.show', $thread->category) }}" class="text-blue-600 hover:underline">{{ $thread->category->name }}</a></span> {{-- Màu link xanh --}}
            </div>

            @if($thread->posts->isNotEmpty())
                <div class="text-gray-700 text-base leading-relaxed mt-4 border-t border-gray-200 pt-4"> 
                    {!! nl2br(e($thread->posts->first()->content)) !!}
                </div>
            @else
                <p class="text-gray-600 italic">Chủ đề này chưa có bài viết nội dung.</p>
            @endif

            @auth
                @can('update', $thread)
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('forum.threads.edit', $thread) }}" class="btn-pixel bg-yellow-500 hover:bg-yellow-600 text-white text-sm"> {{-- Dùng btn-pixel --}}
                            <i class="fas fa-edit mr-1"></i> Sửa chủ đề
                        </a>
                        <form action="{{ route('forum.threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa chủ đề này không?');">
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

        <h2 class="text-xl font-bold text-gray-800 glow-text mb-4 border-b border-gray-200 pb-2">
            Các bài viết và phản hồi
        </h2>

        @if ($posts->isEmpty())
            <p class="text-gray-600 text-center">Chưa có bài viết nào trong chủ đề này. Hãy là người đầu tiên trả lời!</p>
        @else
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" /> 
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif

        @auth
            <div class="bg-white p-6 mt-8 shadow-xl rounded-lg border border-gray-200 game-card"> 
                <h3 class="text-xl font-bold text-gray-800 mb-4">Đăng bài viết mới / Trả lời</h3>
                <form action="{{ route('forum.posts.store', ['thread' => $thread->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                    <div class="mb-4">
                        <x-form-textarea id="content" name="content" rows="6"
                                         placeholder="Viết bài viết hoặc phản hồi của bạn tại đây..."
                                         class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-900"></x-form-textarea> {{-- Input sáng hơn --}}
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <x-form-button type="submit" class="btn-pixel bg-blue-600 hover:bg-blue-700 text-white">
                            Đăng bài
                        </x-form-button>
                    </div>
                </form>
            </div>
        @else
            <p class="text-gray-600 text-center mt-8 text-sm">
                Vui lòng <a href="{{ route('login') }}" class="text-blue-600 hover:underline">đăng nhập</a> để đăng bài viết hoặc phản hồi.
            </p>
        @endauth

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
