@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Sửa bài viết</h1>
        <form method="POST" action="{{ route('forum.posts.update', $post) }}">
            @csrf
            @method('PUT')
            <x-form-input name="content" label="Nội dung" type="textarea" :value="$post->content" required />
            <x-form-button label="Cập nhật" />
        </form>
    </div>
@endsection