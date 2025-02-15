@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Chủ đề -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800">{{ $thread->title }}</h1>
        <p class="text-gray-500 text-sm mt-1">Được tạo vào {{ $thread->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Form Thêm Bài Viết -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Thêm Bài Viết</h2>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Nội dung bài viết</label>
                <textarea id="content" name="content" rows="5" class="mt-2 w-full p-4 border border-gray-300 rounded-lg" placeholder="Nhập nội dung bài viết..."></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                    Đăng bài
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
