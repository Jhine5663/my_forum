@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Phản hồi của bạn</h2>

    @if ($replies->isEmpty())
        <p>Bạn chưa phản hồi bài viết nào.</p>
    @else
        <ul>
            @foreach ($replies as $reply)
                <li class="bg-white p-4 mb-4 rounded shadow">
                    <p class="mb-2">{{ $reply->content }}</p>
                    <a href="{{ route('threads.show', $reply->post->thread_id) }}" class="text-blue-500 text-sm hover:underline">Xem bài viết</a>
                    <p class="text-sm text-gray-500 mt-1">Gửi lúc: {{ $reply->created_at->format('H:i d/m/Y') }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
