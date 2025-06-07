@extends('layouts.admin')

@section('title', 'Quản lý Chủ đề | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Chủ đề</h1>
            {{-- Nút Thêm Chủ đề mới (admin có thể tạo chủ đề cho user khác) --}}
            <a href="{{ route('admin.threads.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Chủ đề mới</span>
            </a>
        </div>

        @if ($threads->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-600 border border-gray-200">
                Chưa có chủ đề nào.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Tiêu đề</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Danh mục</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Người tạo</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Ngày tạo</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Bài viết</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($threads as $thread)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $thread->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ Str::limit($thread->title, 80) }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.categories.show', $thread->category) }}" class="text-blue-600 hover:underline">
                                        {{ $thread->category->name }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.users.show', $thread->user) }}" class="text-blue-600 hover:underline">
                                        {{ $thread->user->user_name }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $thread->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $thread->posts_count ?? $thread->posts->count() }}</td> {{-- Cần withCount('posts') trong Controller --}}
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.threads.edit', $thread) }}" class="text-yellow-600 hover:text-yellow-800" title="Sửa"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.threads.show', $thread) }}" class="text-blue-600 hover:text-blue-800" title="Xem"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('admin.threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa chủ đề này?');">
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
                {{ $threads->links() }}
            </div>
        @endif
    </div>
@endsection