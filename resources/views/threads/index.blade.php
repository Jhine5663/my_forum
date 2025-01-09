@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Danh sách Chủ đề</h2>
    <a href="{{ route('threads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm Chủ đề</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Tiêu đề</th>
                <th class="border px-4 py-2">Thể loại</th>
                <th class="border px-4 py-2">Người tạo</th>
                <th class="border px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($threads as $thread)
            <tr>
                <td class="border px-4 py-2">{{ $thread->id }}</td>
                <td class="border px-4 py-2">{{ $thread->title }}</td>
                <td class="border px-4 py-2">{{ $thread->category->name }}</td>
                <td class="border px-4 py-2">{{ $thread->user->user_name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('threads.edit', $thread) }}" class="text-blue-500">Sửa</a>
                    <form action="{{ route('threads.destroy', $thread) }}" method="POST" class="inline">
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
@endsection
