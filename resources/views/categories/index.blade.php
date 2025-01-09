@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="text-blue-500 hover:text-blue-700">Create New Category</a>

    <div class="mt-4">
        <ul class="space-y-4">
            @foreach($categories as $category)
                <li class="flex justify-between items-center">
                    <span>{{ $category->name }}</span>
                    <div>
                        <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
