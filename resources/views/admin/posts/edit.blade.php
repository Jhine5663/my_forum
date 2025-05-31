@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-700 glow-text mb-4">Sửa bài viết</h1>
    <div class="bg-W-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="content" class="block text-gray-600 font-bold mb-2">Nội dung</label>
                <textarea name="content" id="content" class="w-full py-2 px-3 rounded bg-W-700 text-black focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30" rows="6" required>{{ $post->content }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex space-x-4">
                <x-form-button label="Cập nhật" />
                <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection
