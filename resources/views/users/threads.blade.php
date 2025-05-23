@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chủ đề của {{ $user->user_name }}</h1>
        @if($threads->isEmpty())
            <p class="text-gray-500">Người dùng này chưa tạo chủ đề nào.</p>
        @else
            <div class="space-y-4">
                @foreach($threads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>
            {{ $threads->links() }}
        @endif
    </div>
@endsection