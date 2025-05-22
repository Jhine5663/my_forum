@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Sửa bình luận</h1>
        <form method="POST" action="{{ route('forum.replies.update', $reply) }}">
            @csrf
            @method('PUT')
            <x-form-input name="content" label="Nội dung" type="textarea" :value="$reply->content" required />
            <x-form-button label="Cập nhật" />
        </form>
    </div>
@endsection