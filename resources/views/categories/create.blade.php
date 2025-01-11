@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Thêm Thể Loại Mới</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <!-- Tên Thể Loại -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên Thể Loại</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Nhập tên thể loại" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Slug -->
        <div class="mb-4">
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Nhập slug" required>
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nút Lưu -->
        <div class="text-right">
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-400">
                Lưu Thể Loại
            </button>
        </div>
    </form>
</div>
@endsection
