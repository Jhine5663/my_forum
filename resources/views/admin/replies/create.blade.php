@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-700 glow-text mb-4">Tạo phản hồi mới</h1>

    <div class="bg-W-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('admin.replies.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="post_id" class="block text-gray-600 font-bold mb-2">Chọn bài viết</label>
                <select name="post_id" id="post_id" class="w-full p-2 rounded bg-W-700 text-black border border-blue-500/30 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Chọn bài viết --</option>
                    @foreach($posts as $post)
                        <option value="{{ $post->id }}">
                            {{ Str::limit($post->content, 50) }} (ID: {{ $post->id }})
                        </option>
                    @endforeach
                </select>
                @error('post_id')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="comment" class="block text-gray-600 font-bold mb-2">Nội dung phản hồi</label>
                <textarea name="comment" id="comment" rows="5" class="w-full p-2 rounded bg-W-700 text-black border border-blue-500/30 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <x-form-button label="Gửi phản hồi" />
                <a href="{{ route('admin.replies.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection
