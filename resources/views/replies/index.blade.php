@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Quản lý Phản Hồi</h1>

    <div class="mb-4">
        <a href="{{ route('replies.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
            Thêm Phản Hồi
        </a>
    </div>

    <!-- Danh sách bài viết -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nội Dung</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Bài Viết</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Người Tạo</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($replies as $reply)
                <tr class="border-b">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->comment }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->post->content }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->user->user_name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700 space-x-2">

                        <a href="{{ route('replies.edit', $reply) }}" 
                           class="text-blue-500 hover:underline">Sửa</a>

                        <form action="{{ route('replies.destroy', $reply) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:underline ml-2"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                        Không có bài viết nào.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
