@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="slug" class="block text-sm font-medium">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Category</button>
    </form>
@endsection
