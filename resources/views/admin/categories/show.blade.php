@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chi tiết danh mục</h1>

    <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-6">
        <p><strong>Tên danh mục:</strong> {{ $category->name }}</p>
        <p><strong>Slug:</strong> {{ $category->slug }}</p>
        <p><strong>Hoạt động:</strong> {{ $category->is_active ? 'Có' : 'Không' }}</p>
    </div>

    <div>
        <a href="{{ route('admin.categories.edit', $category) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Sửa danh mục</a>

        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded pixel-btn" 
                    onclick="return confirm('Xóa danh mục này?')">Xóa danh mục</button>
        </form>
    </div>
@endsection
