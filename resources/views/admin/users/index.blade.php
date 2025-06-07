@extends('layouts.admin')

@section('title', 'Quản lý Người dùng | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Người dùng</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Người dùng mới</span>
            </a>
        </div>

        @if ($users->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-600 border border-gray-200">
                Chưa có người dùng nào.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Tên người dùng</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Email</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Vai trò</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Ngày tạo</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Số bài viết</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-200">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->user_name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Người dùng' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">
                                    {{ $user->posts_count ?? $user->posts->count() }} / {{ $user->threads_count ?? $user->threads->count() }}
                                </td> {{-- Cần withCount('posts', 'threads') trong Controller --}}
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-800" title="Sửa"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-800" title="Xem"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa người dùng này?');">
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
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection