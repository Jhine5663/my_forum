@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Hồ sơ người dùng</h2>

    <div class="mb-6">
        <p><strong>Tên:</strong> {{ $user->user_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Ngày tạo:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">Chỉnh sửa thông tin</a>
    </div>

    <hr class="my-6">

    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Chủ đề đã tạo</h3>
        <ul class="list-disc pl-5">
            @forelse($threads as $thread)
                <li>
                    <a href="{{ route('forum.thread', $thread->id) }}" class="text-blue-600 hover:underline">
                        {{ $thread->title }}
                    </a>
                    <span class="text-sm text-gray-500">({{ $thread->created_at->format('d/m/Y') }})</span>
                </li>
            @empty
                <li>Không có chủ đề nào.</li>
            @endforelse
        </ul>
    </div>

    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Bài viết đã đăng</h3>
        <ul class="list-disc pl-5">
            @forelse($posts as $post)
                <li>
                    <a href="{{ route('threads.show', $post->thread_id) }}" class="text-blue-600 hover:underline">
                        {{ Str::limit($post->content, 50) }}
                    </a>
                    <span class="text-sm text-gray-500">({{ $post->created_at->format('d/m/Y') }})</span>
                </li>
            @empty
                <li>Không có bài viết nào.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <h3 class="text-xl font-semibold mb-2">Phản hồi đã gửi</h3>
        <ul class="list-disc pl-5">
            @forelse($replies as $reply)
                <li>
                    <span>{{ Str::limit($reply->content, 50) }}</span>
                    <span class="text-sm text-gray-500">({{ $reply->created_at->format('d/m/Y') }})</span>
                </li>
            @empty
                <li>Không có phản hồi nào.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
