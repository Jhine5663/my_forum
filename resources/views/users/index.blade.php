@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Danh Sách Người Dùng</h1>

    <!-- Nút Thêm Người Dùng -->
    <div class="mb-4">
        <!-- Sửa URL trong link "Thêm Người Dùng" -->
        <a href="{{ route('users.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
            Thêm Người Dùng
        </a>
    </div>

    <!-- Bảng Người Dùng -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tên Người Dùng</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Vai Trò</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $user->user_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ $user->is_admin ? 'Admin' : 'Thành Viên' }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('users.edit', $user->id) }}" 
                               class="text-yellow-500 hover:text-yellow-700">Chỉnh Sửa</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700 ml-2"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Không có người dùng nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
