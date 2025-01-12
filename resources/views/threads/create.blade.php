@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Tạo Chủ Đề Mới</h1>

    <form action="{{ route('threads.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Tiêu Đề -->
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700">Tiêu Đề</label>
            <input type="text" name="title" id="title" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
            @error('title')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nội Dung -->
        <div>
            <label for="body" class="block text-sm font-semibold text-gray-700">Nội Dung</label>
            <textarea name="body" id="body" rows="5" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required></textarea>
            @error('body')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Thể Loại -->
        <div>
            <label for="category_id" class="block text-sm font-semibold text-gray-700">Chọn Thể Loại</label>
            <select name="category_id" id="category_id" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nút Gửi -->
        <div>
            <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md shadow">
                Tạo Chủ Đề
            </button>
        </div>
    </form>
</div>
@endsection
