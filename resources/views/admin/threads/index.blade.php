@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-700 glow-text mb-4">Quản lý chủ đề</h1>
    <div class="mb-4">
        <a href="{{ route('admin.threads.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-black px-4 py-2 rounded pixel-btn">Tạo chủ đề</a>
    </div>
    @if ($threads->isEmpty())
        <p class="text-gray-500">Chưa có chủ đề nào.</p>
    @else
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md border border-blue-500/20">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-blue-500/20">
                        <th class="py-2 px-4 text-black">Tiêu đề</th>
                        <th class="py-2 px-4 text-black">Người đăng</th>
                        <th class="py-2 px-4 text-black">Danh mục</th>
                        <th class="py-2 px-4 text-black">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($threads as $thread)
                        <tr class="border-b border-blue-500/20">
                            <td class="py-2 px-4 text-black">
                                <a href="{{ route('admin.threads.show', $thread) }}"
                                    class="text-blue-400 hover:underline">{{ $thread->title }}</a>
                            </td>
                            <td class="py-2 px-4 text-black">{{ $thread->user->user_name }}</td>
                            <td class="py-2 px-4 text-black">
                                <a href="{{ route('admin.categories.show', $thread->category) }}"
                                    class="text-blue-400 hover:underline">
                                    {{ $thread->category->name }}
                                </a>
                            </td>
                            <td class="py-2 px-4">
                                <a href="{{ route('admin.threads.edit', $thread) }}"
                                    class="text-blue-400 hover:underline">Sửa</a>
                                <form action="{{ route('admin.threads.destroy', $thread) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline ml-2"
                                        onclick="return confirm('Xóa chủ đề này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
