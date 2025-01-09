@extends('layouts.app')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Category Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="slug" class="block text-sm font-medium">Slug</label>
            <input type="text" name="slug" id="slug" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Category</button>
    </form>
@endsection
