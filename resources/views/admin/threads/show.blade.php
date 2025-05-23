@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">{{ $thread->title }}</h1>
    <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-4">
        <p class="text-white">Đăng bởi {{ $thread->user->user_name }} trong
            <a href="#" class="text-blue-400 hover:underline">{{ $thread->category->name }}</a>
        </p>
        <p class="text-sm text-gray-400">Ngày đăng: {{ $thread->created_at->format('d/m/Y') }}</p>

        <div class="mt-4">
            <a href="{{ route('admin.threads.edit', $thread) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Sửa</a>
            <form action="{{ route('admin.threads.destroy', $thread) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded pixel-btn ml-2" onclick="return confirm('Xóa chủ đề này?')">Xóa</button>
            </form>
        </div>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Bài viết</h2>
    @if($thread->posts->isEmpty())
        <p class="text-gray-500">Chưa có bài viết nào.</p>
    @else
        <div class="space-y-4">
            @foreach($thread->posts as $post)
                <div class="bg-gray-800 p-4 rounded-lg border border-blue-500/20">
                    <p class="text-white">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                    <p class="text-sm text-gray-400">
                        Đăng bởi {{ $post->user->user_name }} vào {{ $post->created_at->format('d/m/Y') }}
                    </p>

                    @if($post->replies->isNotEmpty())
                        <div class="ml-6 mt-2 space-y-2">
                            @foreach($post->replies as $reply)
                                <div class="bg-gray-800 p-3 rounded-lg border border-blue-500/20">
                                    <p class="text-white text-sm">{{ \Illuminate\Support\Str::limit($reply->content, 80) }}</p>
                                    <p class="text-xs text-gray-400">
                                        Bình luận bởi {{ $reply->user->user_name }} vào {{ $reply->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
@endsection
