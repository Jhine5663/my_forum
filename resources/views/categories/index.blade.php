@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Danh Sách Thể Loại</h1>

    <!-- Nút Thêm Thể Loại -->
    <div class="mb-4">
        <a href="{{ route('categories.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
            Thêm Thể Loại
        </a>
    </div>

    <!-- Bảng Thể Loại -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tên Thể Loại</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Slug</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Trạng Thái</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('threads.index', $category) }}" class="text-blue-500 hover:text-blue-700">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $category->slug }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            @if($category->is_active)
                                <span class="text-green-600 font-semibold">Hoạt động</span>
                            @else
                                <span class="text-red-600 font-semibold">Không hoạt động</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('categories.edit', $category) }}" 
                               class="text-yellow-500 hover:text-yellow-700">Chỉnh Sửa</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700 ml-2"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này không?');">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Không có thể loại nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
