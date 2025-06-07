@extends('layouts.admin')

@section('title', 'Chi tiết Bài viết | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Chi tiết Bài viết: {{ Str::limit($post->content, 30) }}</h1>
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <div class="space-y-4 text-gray-700">
            <div>
                <p class="text-sm font-semibold text-gray-600">ID:</p>
                <p class="text-base">{{ $post->id }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Nội dung:</p>
                <p class="text-base">{!! nl2br(e($post->content)) !!}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Thuộc Chủ đề:</p>
                <p class="text-base">
                    <a href="{{ route('admin.threads.show', $post->thread) }}" class="text-blue-600 hover:underline">
                        {{ $post->thread->title }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Người đăng:</p>
                <p class="text-base">
                    <a href="{{ route('admin.users.show', $post->user) }}" class="text-blue-600 hover:underline">
                        {{ $post->user->user_name }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Ngày đăng:</p>
                <p class="text-base">{{ $post->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Cập nhật cuối cùng:</p>
                <p class="text-base">{{ $post->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Phản hồi:</p>
                <p class="text-base">{{ $post->replies_count ?? $post->replies->count() }}</p>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2"></i> Sửa Bài viết
            </a>
            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa bài viết này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa Bài viết
                </button>
            </form>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Các phản hồi của bài viết này</h2>
            <div class="space-y-4">
                @if($post->replies->isEmpty())
                    <p class="text-gray-600 italic text-center">Chưa có phản hồi nào cho bài viết này.</p>
                @else
                    @foreach($post->replies as $reply)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex items-center mb-2">
                                <img src="{{ $reply->user->avatar ? asset('storage/' . $reply->user->avatar) : 'https://via.placeholder.com/24/e0f2fe/1e3c72?text=U' }}" alt="{{ $reply->user->user_name }}" class="w-6 h-6 rounded-full mr-2">
                                <a href="{{ route('admin.users.show', $reply->user) }}" class="font-medium text-gray-800 hover:underline">{{ $reply->user->user_name }}</a>
                                <span class="text-gray-500 text-xs ml-auto">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 text-sm">{!! nl2br(e($reply->comment)) !!}</p>
                            <div class="mt-3 flex space-x-2 justify-end">
                                <a href="{{ route('admin.replies.edit', $reply) }}" class="text-yellow-600 hover:text-yellow-800 text-sm"><i class="fas fa-edit"></i> Sửa</a>
                                <form action="{{ route('admin.replies.destroy', $reply) }}" method="POST" onsubmit="return confirm('Xóa phản hồi này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"><i class="fas fa-trash-alt"></i> Xóa</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection