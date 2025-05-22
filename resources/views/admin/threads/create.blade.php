@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Tạo chủ đề</h1>
    <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('admin.threads.store') }}" method="POST">
            @csrf
            <x-form-input name="title" label="Tiêu đề" :value="old('title')" required />
            <div class="mb-4">
                <label for="category_id" class="block text-gray-300 font-bold mb-2">Danh mục</label>
                <select name="category_id" id="category_id" class="w-full py-2 px-3 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex space-x-4">
                <x-form-button label="Tạo" />
                <a href="{{ route('admin.threads.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection
