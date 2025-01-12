@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">Thêm Thể Loại Mới</h1>
    
    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Tên Thể Loại</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Nhập tên thể loại">
            @error('name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="is_active" class="block text-sm font-semibold text-gray-700">Trạng thái</label>
            <select name="is_active" id="is_active" 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-sm font-semibold text-gray-700">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Nhập slug nếu có (hoặc để trống để tự tạo)">
            @error('slug')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Lưu Thể Loại</button>
    </form>
</div>
@endsection
