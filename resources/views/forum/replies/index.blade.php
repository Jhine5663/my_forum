@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Quản lý bình luận</h1>
    @if($replies->isEmpty())
        <p class="text-gray-500">Chưa có bình luận nào.</p>
    @else
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-blue-500/20">
                        <th class="py-2 px-4 text-white">Nội dung</th>
                        <th class="py-2 px-4 text-white">Người đăng</th>
                        <th class="py-2 px-4 text-white">Bài viết</th>
                        <th class="py-2 px-4 text-white">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($replies as $reply)
                        <tr class="border-b border-blue-500/20">
                            <td class="py-2 px-4 text-white">{{ \Illuminate\Support\Str::limit($reply->content, 50) }}</td>
                            <td class="py-2 px-4 text-white">{{ $reply->user->user_name }}</td>
                            <td class="py-2 px-4 text-white">
                                <a href="{{ route('posts.edit', $reply->post) }}" class="text-blue-400 hover:underline">{{ \Illuminate\Support\Str::limit($reply->post->content, 30) }}</a>
                            </td>
                            <td class="py-2 px-4">
                                <a href="{{ route('replies.edit', $reply) }}" class="text-blue-400 hover:underline">Sửa</a>
                                <form action="{{ route('replies.destroy', $reply) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline ml-2" onclick="return confirm('Xóa bình luận này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
