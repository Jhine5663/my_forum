@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Danh sách chủ đề</h1>
        @if($threads->isEmpty())
            <p class="text-gray-500">Chưa có chủ đề nào.</p>
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