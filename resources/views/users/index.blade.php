@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Danh sách người dùng</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-200">Name</th>
                <th class="px-4 py-2 border border-gray-200">Email</th>
                <th class="px-4 py-2 border border-gray-200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="px-4 py-2 border border-gray-200">{{ $user->user_name }}</td>
                <td class="px-4 py-2 border border-gray-200">{{ $user->email }}</td>
                <td class="px-4 py-2 border border-gray-200">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Chỉnh sửa</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div class="mx-auto p-4">
    <a href="{{ route('users.create') }}" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded mb-4">Thêm người dùng</a>

</div>
@endsection
