@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chi tiết người dùng</h1>

    <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-6">
        <p><strong>Tên người dùng:</strong> {{ $user->user_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Quyền admin:</strong> {{ $user->is_admin ? 'Có' : 'Không' }}</p>
        <p><strong>Ngày tạo:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div>
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Sửa người dùng</a>

        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded pixel-btn" 
                    onclick="return confirm('Xóa người dùng này?')">Xóa người dùng</button>
        </form>
    </div>
@endsection
