@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Danh sách bài viết</h1>
        @if($posts->isEmpty())
            <p class="text-gray-500">Chưa có bài viết nào.</p>
        @else
            <div class="space-y-4">
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
            {{ $posts->links() }}
        @endif
    </div>
@endsection