@extends('layouts.admin')

@section('title', 'Chi tiết Chủ đề: ' . Str::limit($thread->title, 30) . ' | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Chi tiết Chủ đề: {{ Str::limit($thread->title, 50) }}</h1>
            <a href="{{ route('admin.threads.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <div class="space-y-4 text-gray-700 mb-6 p-4 border rounded-lg bg-gray-50 border-gray-200">
            <div>
                <p class="text-sm font-semibold text-gray-600">ID:</p>
                <p class="text-base">{{ $thread->id }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tiêu đề:</p>
                <p class="text-base">{{ $thread->title }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Danh mục:</p>
                <p class="text-base">
                    <a href="{{ route('admin.categories.show', $thread->category) }}" class="text-blue-600 hover:underline">
                        {{ $thread->category->name }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Người tạo:</p>
                <p class="text-base">
                    <a href="{{ route('admin.users.show', $thread->user) }}" class="text-blue-600 hover:underline">
                        {{ $thread->user->user_name }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Ngày tạo:</p>
                <p class="text-base">{{ $thread->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Cập nhật cuối cùng:</p>
                <p class="text-base">{{ $thread->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Bài viết:</p>
                <p class="text-base">{{ $thread->posts_count ?? $thread->posts->count() }}</p>
            </div>
        </div>

        <div class="mb-6 flex space-x-2">
            <a href="{{ route('admin.threads.edit', $thread) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2"></i> Sửa Chủ đề
            </a>
            <form action="{{ route('admin.threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa chủ đề này và tất cả bài viết/bình luận liên quan?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa Chủ đề
                </button>
            </form>
        </div>

        {{-- Danh sách các bài viết (Posts) trong chủ đề này --}}
        <div class="mt-8 border-t border-gray-200 pt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Các bài viết trong chủ đề này</h2>
            <div class="space-y-4">
                @if($posts->isEmpty())
                    <p class="text-gray-600 italic text-center">Chưa có bài viết nào trong chủ đề này.</p>
                @else
                    @foreach($posts as $post)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex items-center mb-2">
                                <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://via.placeholder.com/24/f0f4f8/1e3c72?text=U' }}" alt="{{ $post->user->user_name }}" class="w-6 h-6 rounded-full mr-2">
                                <a href="{{ route('admin.users.show', $post->user) }}" class="font-medium text-gray-800 hover:underline">{{ $post->user->user_name }}</a>
                                <span class="text-gray-500 text-xs ml-auto">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 text-sm mb-3">{!! nl2br(e($post->content)) !!}</p>
                            <div class="flex items-center mt-2 text-sm">
                                <span class="text-gray-600 mr-4"><i class="far fa-comment mr-1"></i> {{ $post->replies_count ?? $post->replies->count() }} phản hồi</span>
                                <div class="ml-auto flex space-x-2">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i> Sửa</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Xóa bài viết này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i> Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection