@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Bình luận của {{ $user->user_name }}</h1>
        @if($replies->isEmpty())
            <p class="text-gray-500">Người dùng này chưa viết bình luận nào.</p>
        @else
            <div class="space-y-4">
                @foreach($replies as $reply)
                    <x-reply-card :reply="$reply" />
                @endforeach
            </div>
            {{ $replies->links() }}
        @endif
    </div>
@endsection