@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Tạo bài viết mới</h1>
        <form method="POST" action="{{ route('forum.posts.store', $thread) }}">
            @csrf
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            <x-form-input name="content" label="Nội dung" type="textarea" required />
            <x-form-button label="Tạo bài viết" />
        </form>
    </div>
@endsection
