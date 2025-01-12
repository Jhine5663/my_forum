@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Thêm Bài Viết Mới</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nội dung bài viết -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Nội Dung</label>
            <textarea id="content" name="content" rows="5" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required></textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        {{-- Chủ đề --}}
        <div>
            <label for="thread_id" class="block text-sm font-semibold text-gray-700">Chọn Chủ Đề</label>
            <select name="thread_id" id="thread_id" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
                @foreach($threads as $thread)
                    <option value="{{ $thread->id }}">{{ $thread->title }}</option>
                @endforeach
            </select>
            @error('thread_id')
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
