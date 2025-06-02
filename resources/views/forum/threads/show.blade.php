@extends('layouts.forum')

@section('title', $thread->title . ' | Diễn đàn Game 2D')
@section('meta_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))
@section('og_title', $thread->title)
@section('og_description', Str::limit($thread->posts->first()->content ?? $thread->title, 150))
{{-- @section('og_image', asset($thread->user->avatar_url ?? 'images/default_user_avatar.png')) --}}

@section('forum-content')
    <div class="flex-1 p-6">
        {{-- Breadcrumbs --}}
        <nav class="text-sm font-semibold mb-4 flex items-center space-x-2 text-gray-400">
            <a href="{{ route('forum.index') }}" class="hover:text-blue-400"><i class="fas fa-home"></i> Diễn đàn</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('forum.categories.show', $thread->category) }}" class="hover:text-blue-400">{{ $thread->category->name }}</a>
            <span class="text-gray-500">/</span>
            <span class="text-white">{{ Str::limit($thread->title, 50) }}</span>
        </nav>

        <div class="bg-gray-800 p-6 mb-6 shadow-xl rounded-lg border border-blue-500/30 game-card">
            <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-3">
                {{ $thread->title }}
            </h1>
            <div class="flex items-center text-gray-400 text-sm mb-4 space-x-4">
                <div class="flex items-center">
                    @if($thread->user->avatar)
                        <img src="{{ asset('storage/' . $thread->user->avatar) }}" alt="{{ $thread->user->name }}" class="w-8 h-8 rounded-full mr-2 border-2 border-blue-400">
                    @else
                        <i class="fas fa-user-circle text-2xl mr-2"></i>
                    @endif
                    <span>Đăng bởi <a href="{{ route('profile.show', $thread->user) }}" class="text-blue-400 hover:underline font-medium">{{ $thread->user->name }}</a></span>
                </div>
                <span><i class="far fa-clock mr-1"></i> {{ $thread->created_at->diffForHumans() }}</span>
                <span><i class="fas fa-folder-open mr-1"></i> <a href="{{ route('forum.categories.show', $thread->category) }}" class="text-purple-400 hover:underline">{{ $thread->category->name }}</a></span>
            </div>

            @if($thread->posts->isNotEmpty())
                <div class="text-gray-300 text-base leading-relaxed mt-4 border-t border-gray-700 pt-4">
                    {!! nl2br(e($thread->posts->first()->content)) !!} {{-- Dùng nl2br(e()) để giữ định dạng dòng và chống XSS --}}
                </div>
            @else
                <p class="text-gray-400 italic">Chủ đề này chưa có bài viết nội dung.</p>
            @endif

            @auth
                @can('update', $thread) 
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('forum.threads.edit', $thread) }}" class="pixel-btn bg-yellow-500 hover:bg-yellow-600 text-white text-sm">
                            <i class="fas fa-edit mr-1"></i> Sửa chủ đề
                        </a>
                        <form action="{{ route('forum.threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa chủ đề này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="pixel-btn bg-red-500 hover:bg-red-600 text-white text-sm">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa chủ đề
                            </button>
                        </form>
                    </div>
                @endcan
            @endauth
        </div>

        <h2 class="text-xl font-bold pixel-font text-blue-400 glow-text mb-4 border-b border-blue-500/20 pb-2">
            Các bài viết và phản hồi
        </h2>

        @if ($posts->isEmpty())
            <p class="text-gray-400 text-center">Chưa có bài viết nào trong chủ đề này. Hãy là người đầu tiên trả lời!</p>
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
            <div class="bg-gray-800 p-6 mt-8 shadow-xl rounded-lg border border-blue-500/30 game-card">
                <h3 class="text-xl font-bold text-white mb-4 pixel-font">Đăng bài viết mới / Trả lời</h3>
                <form action="{{ route('forum.posts.store', ['thread' => $thread->id]) }}" method="POST"> 
                    @csrf
                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                    <div class="mb-4">
                        <x-form-textarea id="content" name="content" rows="6"
                                         placeholder="Viết bài viết hoặc phản hồi của bạn tại đây..."></x-form-textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <x-form-button type="submit" class="pixel-btn bg-blue-600 hover:bg-blue-700">
                            Đăng bài
                        </x-form-button>
                    </div>
                </form>
            </div>
        @else
            <p class="text-gray-400 text-center mt-8 text-sm">
                Vui lòng <a href="{{ route('login') }}" class="text-blue-400 hover:underline">đăng nhập</a> để đăng bài viết hoặc phản hồi.
            </p>
        @endauth

        @if($recommendedPosts->isNotEmpty())
            <div class="mt-8 p-6 bg-gray-800 shadow-xl rounded-lg border border-blue-500/30 game-card">
                <h3 class="text-xl font-semibold mb-4 text-blue-400 pixel-font">Bài viết liên quan từ Omnisiah</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($recommendedPosts as $recPost)
                        <x-suggestion :item="$recPost" type="post" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('sidebar')
    <x-sidebar />
@endsection