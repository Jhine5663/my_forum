@extends('layouts.forum')
@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Sửa chủ đề</h1>
        <form method="POST" action="{{ route('forum.threads.update', $thread) }}">
            @csrf
            @method('PUT')
            <x-form-input name="title" label="Tiêu đề" :value="$thread->title" required />
            <div class="mb-4">
                <label for="category_id" class="block text-gray-300 font-bold mb-2">Danh mục</label>
                <select name="category_id" id="category_id" class="w-full py-2 px-3 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $thread->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form-button label="Cập nhật" />
        </form>
    </div>
@endsection