@extends('layouts.admin')

@section('title', 'Chi tiết Danh mục: ' . $category->name . ' | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Chi tiết Danh mục: {{ $category->name }}</h1>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <div class="space-y-4 text-gray-700">
            <div>
                <p class="text-sm font-semibold text-gray-600">ID:</p>
                <p class="text-base">{{ $category->id }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tên Danh mục:</p>
                <p class="text-base">{{ $category->name }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Slug:</p>
                <p class="text-base">{{ $category->slug }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Mô tả:</p>
                <p class="text-base">{{ $category->description ?? 'Không có mô tả' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Trạng thái Hoạt động:</p>
                <p class="text-base">
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $category->is_active ? 'Có' : 'Không' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Chủ đề:</p>
                <p class="text-base">{{ $category->threads_count ?? $category->threads->count() }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Ngày tạo:</p>
                <p class="text-base">{{ $category->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Cập nhật cuối cùng:</p>
                <p class="text-base">{{ $category->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2"></i> Sửa Danh mục
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa danh mục này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa Danh mục
                </button>
            </form>
        </div>
    </div>
@endsection