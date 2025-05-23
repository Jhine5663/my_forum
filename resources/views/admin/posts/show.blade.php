@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chi tiết bài viết</h1>

    <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-6">
        <h2 class="text-xl font-bold text-white mb-2">Nội dung bài viết</h2>
        <p class="text-white whitespace-pre-wrap">{{ $post->content }}</p>
    </div>

    <div class="mb-4">
        <p><strong>Người đăng:</strong> {{ $post->user->user_name }}</p>
        <p><strong>Chủ đề:</strong> 
            <a href="{{ route('admin.threads.show', $post->thread) }}" class="text-blue-400 hover:underline">
                {{ $post->thread->title }}
            </a>
        </p>
        <p><strong>Số phản hồi:</strong> {{ $post->replies->count() }}</p>
    </div>

    {{-- Phần hiển thị các phản hồi --}}
    <div class="mt-6">
        <h2 class="text-xl font-bold text-white mb-4">Danh sách phản hồi</h2>

        @if($post->replies->isEmpty())
            <p class="text-gray-400">Chưa có phản hồi nào cho bài viết này.</p>
        @else
            <ul class="space-y-4">
                @foreach($post->replies as $reply)
                    <li class="bg-gray-700 p-4 rounded shadow">
                        <p class="text-white whitespace-pre-wrap">{{ $reply->comment }}</p>
                        <p class="text-gray-400 text-sm mt-2">
                            - {{ $reply->user->user_name ?? 'Người dùng đã xóa' }}
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Sửa bài viết</a>

        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded pixel-btn" 
                    onclick="return confirm('Xóa bài viết này?')">Xóa bài viết</button>
        </form>
    </div>
@endsection
