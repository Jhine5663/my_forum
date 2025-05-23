@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Quản lý người dùng</h1>
    <div class="mb-4">
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Tạo người dùng</a>
    </div>
    @if($users->isEmpty())
        <p class="text-gray-500">Chưa có người dùng nào.</p>
    @else
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20">
            <table class="w-full text-left">
                <thead>
                <tr class="border-b border-blue-500/20">
                    <th class="py-2 px-4 text-white">Tên người dùng</th>
                    <th class="py-2 px-4 text-white">Email</th>
                    <th class="py-2 px-4 text-white">Admin</th>
                    <th class="py-2 px-4 text-white whitespace-nowrap">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-blue-500/20">
                        <td class="py-2 px-4 text-white">{{ $user->user_name }}</td>
                        <td class="py-2 px-4 text-white">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-white">{{ $user->is_admin ? 'Có' : 'Không' }}</td>
                        <td class="py-2 px-4 whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:underline">Sửa</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline ml-2" onclick="return confirm('Xóa người dùng này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
