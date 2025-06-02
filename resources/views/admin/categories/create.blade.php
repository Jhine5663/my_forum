@extends('layouts.admin')
@section('admin-content')
    <h1 class="text-2xl font-bold pixel-font text-blue-700 glow-text mb-4">Tạo chuyên mục</h1>
    <div class="bg-White-800 p-6 rounded-lg shadow-md border border-blue-500/20">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <x-form-input name="name" label="Tên danh mục" :value="old('name')" required />
            <x-form-input name="slug" label="Slug" :value="old('slug')" />
            <div class="mb-4">
                {{-- <input type="hidden" name="is_active" value="0"> --}}
                <label for="is_active" class="block text-gray-600 font-bold mb-2">Hoạt động</label>
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }} class="rounded bg-gray-700 text-blue-500 focus:ring-blue-500">
            </div>
            <div class="flex space-x-4">
                <x-form-button label="Tạo" />
                <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded pixel-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection
