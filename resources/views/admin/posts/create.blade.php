@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4 text-blue-500">Tạo bài viết mới</h1>

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="thread_id" class="block text-gray-700 font-semibold mb-2">Chọn chủ đề</label>
            <select name="thread_id" id="thread_id" required
                class="w-full p-2 border rounded bg-gray-50">
                <option value="">-- Chọn chủ đề --</option>
                @foreach($threads as $thread)
                    <option value="{{ $thread->id }}" {{ old('thread_id') == $thread->id ? 'selected' : '' }}>
                        {{ $thread->title }}
                    </option>
                @endforeach
            </select>
            @error('thread_id')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-semibold mb-2">Nội dung bài viết</label>
            <textarea name="content" id="content" rows="5" required
                class="w-full p-2 border rounded bg-gray-50">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
            Tạo bài viết
        </button>
        <a href="{{ route('admin.posts.index') }}" 
           class="ml-4 text-gray-600 hover:text-gray-900">Hủy</a>
    </form>
@endsection
