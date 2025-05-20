@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-5xl">
    <!-- Chỉ sử dụng biến $thread -->
    <!-- Breadcrumb -->
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('forum.index') }}" class="hover:text-blue-500">Trang chủ</a>
        <span class="mx-2">/</span>
        <a href="{{ route('categories.threads', $thread->category) }}" class="hover:text-blue-500">{{ $thread->category->name }}</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ Str::limit($thread->title, 50) }}</span>
    </div>

    <!-- Chi tiết chủ đề -->
    <div class="bg-white shadow-sm rounded-lg mb-6 overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 p-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $thread->title }}</h1>
            <div class="flex items-center mt-2 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                    </svg>
                    <span class="font-medium text-gray-900">{{ $thread->user->user_name }}</span>
                </div>
                <span class="mx-2">•</span>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $thread->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
        <div class="p-6 prose max-w-none">
            {{ $thread->body }}
        </div>
    </div>

    <!-- Danh sách bài viết -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="border-b border-gray-200 p-4 bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Bài viết trong chủ đề này ({{ $thread->posts->count() }})</h2>
            @auth
                <a href="{{ route('posts.create', ['thread_id' => $thread->id]) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Thêm bài viết
                </a>
            @endauth
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($thread->posts as $post)
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">{{ substr($post->user->user_name, 0, 2) }}</span>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $post->user->user_name }}</h3>
                                <p class="text-xs text-gray-500">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        @if(auth()->check() && (auth()->user()->id === $post->user_id || auth()->user()->is_admin))
                            <div class="flex items-center space-x-2 text-sm">
                                <a href="{{ route('posts.edit', $post->id) }}" 
                                   class="text-blue-600 hover:text-blue-800">Sửa</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                        Xóa
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="prose max-w-none text-gray-700">
                        {{ $post->content }}
                    </div>

                    <!-- Phần replies -->
                    <div class="mt-4 space-y-3">
                        @foreach($post->replies as $reply)
                            <div class="ml-8 bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-medium text-gray-900">{{ $reply->user->user_name }}</span>
                                        <span class="text-xs text-gray-500">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    @if(auth()->check() && (auth()->user()->id === $reply->user_id || auth()->user()->is_admin))
                                        <form action="{{ route('replies.destroy', $reply->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-xs text-red-600 hover:text-red-800"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa phản hồi này?')">
                                                Xóa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-700">{{ $reply->content }}</p>
                            </div>
                        @endforeach

                        @auth
                            <div class="ml-8 mt-2">
                                <form action="{{ route('replies.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="flex space-x-2">
                                        <input type="text" name="content" 
                                               class="flex-1 min-w-0 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                               placeholder="Thêm phản hồi...">
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Gửi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <p class="text-gray-500">Chưa có bài viết nào trong chủ đề này</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
