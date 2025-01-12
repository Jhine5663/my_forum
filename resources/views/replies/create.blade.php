@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Thêm Phản Hồi Mới</h1>

    <form action="{{ route('replies.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nội dung phản hồi -->
        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700">Nội Dung</label>
            <textarea id="comment" name="comment" rows="5" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required></textarea>
            @error('comment')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        {{-- Bài viết --}}
        <div>
            <label for="post_id" class="block text-sm font-semibold text-gray-700">Bài Viết</label>
            <select name="post_id" id="post_id" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->content }}</option>
                @endforeach
            </select>
            @error('post_id')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <!-- Nút gửi -->
        <div>
            <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md shadow">
                Thêm Bài Viết
            </button>
        </div>
    </form>
</div>
@endsection
