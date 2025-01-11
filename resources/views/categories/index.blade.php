@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Danh sách Thể Loại</h1>
    
    <!-- Nút Tạo Mới -->
    <div class="mb-6 text-right">
        <a href="{{ route('categories.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-400">
            Thêm Thể Loại Mới
        </a>
    </div>

    <!-- Danh sách Thể Loại -->
    @if($categories->isEmpty())
        <p class="text-gray-500">Chưa có thể loại nào.</p>
    @else
        <div class="overflow-hidden rounded-md border border-gray-200 shadow">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Tên Thể Loại</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Mô Tả</th>
                        <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Trạng Thái</th>
                        <th class="py-2 px-4 text-right text-sm font-semibold text-gray-600">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : '' }}">
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $category->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $category->description }}</td>
                            <td class="py-2 px-4 text-center">
                                <span class="px-2 py-1 text-xs font-medium rounded {{ $category->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $category->status ? 'Kích Hoạt' : 'Vô Hiệu Hóa' }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-right">
                                <a href="{{ route('categories.edit', $category) }}" 
                                   class="text-yellow-500 hover:text-yellow-600 mr-2">
                                    Sửa
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
