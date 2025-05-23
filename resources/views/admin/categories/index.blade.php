@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Quản lý danh mục</h1>
    <div class="mb-4">
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn">Tạo danh mục</a>
    </div>
    @if($categories->isEmpty())
        <p class="text-gray-500">Chưa có danh mục nào.</p>
    @else
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-blue-500/20">
                        <th class="py-2 px-4 text-white">Tên danh mục</th>
                        <th class="py-2 px-4 text-white">Slug</th>
                        <th class="py-2 px-4 text-white">Hoạt động</th>
                        <th class="py-2 px-4 text-white">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b border-blue-500/20">
                            <td class="py-2 px-4 text-white">{{ $category->name }}</td>
                            <td class="py-2 px-4 text-white">{{ $category->slug }}</td>
                            <td class="py-2 px-4 text-white">{{ $category->is_active ? 'Có' : 'Không' }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-400 hover:underline">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline ml-2" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection