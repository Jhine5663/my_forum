@extends('layouts.admin')

@section('title', 'Quản lý Phản hồi | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Phản hồi</h1>
            <a href="{{ route('admin.replies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Phản hồi mới</span>
            </a>
        </div>

        @if ($replies->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-600 border border-gray-200">
                Chưa có phản hồi nào.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Nội dung</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Bài viết gốc</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Người đăng</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Ngày đăng</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($replies as $reply)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $reply->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ Str::limit($reply->comment, 80) }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.posts.show', $reply->post) }}" class="text-blue-600 hover:underline" title="{{ Str::limit($reply->post->content, 50) }}">
                                        {{ Str::limit($reply->post->content, 40) }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.users.show', $reply->user) }}" class="text-blue-600 hover:underline">
                                        {{ $reply->user->user_name }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $reply->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.replies.edit', $reply) }}" class="text-yellow-600 hover:text-yellow-800" title="Sửa"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.replies.destroy', $reply) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa phản hồi này?');">
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
                {{ $replies->links() }}
            </div>
        @endif
    </div>
@endsection