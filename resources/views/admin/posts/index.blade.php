@extends('layouts.admin')

@section('admin-content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text">Quản lý bài viết</h1>
        <a href="{{ route('admin.posts.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded pixel-btn">
            + Tạo bài viết
        </a>
    </div>

    @if ($posts->isEmpty())
        <p class="text-gray-500">Chưa có bài viết nào.</p>
    @else
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-blue-500/20">
                        <th class="py-2 px-4 text-white">Nội dung</th>
                        <th class="py-2 px-4 text-white">Người đăng</th>
                        <th class="py-2 px-4 text-white">Chủ đề</th>
                        <th class="py-2 px-4 text-white">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b border-blue-500/20">
                            <td class="py-2 px-4 text-white"> 
                                <a href="{{ route('admin.threads.show', $post->thread) }}"
                                    class="text-blue-400 hover:underline">
                                    {{ \Illuminate\Support\Str::limit($post->content, 10) }}
                                </a></td>
                            <td class="py-2 px-4 text-white">{{ $post->user->user_name }}</td>
                            <td class="py-2 px-4 text-white">
                                <a href="{{ route('admin.threads.show', $post->thread) }}"
                                    class="text-blue-400 hover:underline">
                                    {{ $post->thread->title }}
                                </a>
                            </td>
                            <td class="py-2 px-4">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-blue-400 hover:underline">Sửa</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline ml-2"
                                        onclick="return confirm('Xóa bài viết này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
