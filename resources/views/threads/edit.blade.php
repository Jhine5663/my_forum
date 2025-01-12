@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">Chỉnh Sửa Chủ Đề</h1>

    <form action="{{ route('threads.update', $thread) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-semibold text-gray-700">Tiêu Đề</label>
            <input type="text" name="title" id="title" value="{{ old('title', $thread->title) }}" required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Nhập tiêu đề">
        </div>

        <div class="mb-4">
            <label for="body" class="block text-sm font-semibold text-gray-700">Nội Dung</label>
            <textarea name="body" id="body" rows="5" required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Nhập nội dung">{{ old('body', $thread->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-semibold text-gray-700">Chọn Thể Loại</label>
            <select name="category_id" id="category_id" required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $thread->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">
            Cập Nhật Chủ Đề
        </button>
    </form>
</div>
@endsection
