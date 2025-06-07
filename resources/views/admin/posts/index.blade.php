@extends('layouts.admin')

@section('title', 'Quản lý Bài viết | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Bài viết</h1>
            <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Bài viết mới</span>
            </a>
        </div>

        @if ($posts->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-600 border border-gray-200">
                Chưa có bài viết nào.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Nội dung</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Chủ đề</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Người đăng</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Ngày đăng</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Phản hồi</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ Str::limit($post->content, 80) }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.threads.show', $post->thread) }}" class="text-blue-600 hover:underline">
                                        {{ Str::limit($post->thread->title, 40) }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.users.show', $post->user) }}" class="text-blue-600 hover:underline">
                                        {{ $post->user->user_name }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->replies_count ?? $post->replies->count() }}</td> {{-- Cần withCount('replies') trong Controller --}}
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-yellow-600 hover:text-yellow-800" title="Sửa"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa bài viết này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection