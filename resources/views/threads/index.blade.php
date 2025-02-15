@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Danh Sách Chủ Đề</h1>

    <div class="mb-4">
        <a href="{{ route('threads.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
            Thêm Chủ Đề
        </a>
    </div>

    <!-- Bảng Chủ Đề -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tiêu Đề</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Thể Loại</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Ngày Tạo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($threads as $thread)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('posts.index', $thread) }}" class="text-blue-500 hover:text-blue-700">
                                {{ $thread->title }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $thread->category->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $thread->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('threads.edit', $thread) }}" 
                               class="text-yellow-500 hover:text-yellow-700">Chỉnh Sửa</a>
                            <form action="{{ route('threads.destroy', $thread) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700 ml-2"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa chủ đề này không?');">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Không có chủ đề nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
