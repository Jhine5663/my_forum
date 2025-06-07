@extends('layouts.admin')

@section('title', 'Quản lý Danh mục | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Danh mục</h1>
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Danh mục mới</span>
            </a>
        </div>

        @if ($categories->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-600 border border-gray-200">
                Chưa có danh mục nào được tạo.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Tên Danh mục</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Slug</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Mô tả</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hoạt động</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Chủ đề</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $category->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $category->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $category->slug }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ Str::limit($category->description ?? 'Không có', 50) }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $category->is_active ? 'Có' : 'Không' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $category->threads_count ?? $category->threads->count() }}</td> {{-- Cần withCount('threads') trong Controller --}}
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-yellow-600 hover:text-yellow-800" title="Sửa"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa danh mục này?');">
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
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection