@extends('layouts.forum')

@section('title', 'Tạo Chủ đề Mới | Diễn đàn Game 2D')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-6 text-center">Tạo Chủ đề Mới</h1>

        <div class="bg-gray-800 p-8 shadow-xl rounded-lg border border-blue-500/30 game-card max-w-2xl mx-auto">
            <form action="{{ route('forum.threads.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block text-white text-lg font-semibold mb-2">Tiêu đề Chủ đề:</label>
                    <x-form-input type="text" id="title" name="title" value="{{ old('title') }}"
                                  placeholder="Nhập tiêu đề chủ đề của bạn" required autofocus />
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id" class="block text-white text-lg font-semibold mb-2">Chọn Chuyên mục:</label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-blue-600 text-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-200">
                        <option value="">-- Chọn chuyên mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-white text-lg font-semibold mb-2">Nội dung bài viết:</label>
                    <x-form-textarea id="content" name="content" rows="10"
                                     placeholder="Bắt đầu cuộc thảo luận của bạn tại đây...">{{ old('content') }}</x-form-textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <x-form-button type="submit" class="pixel-btn bg-blue-600 hover:bg-blue-700">
                        Tạo Chủ đề
                    </x-form-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('sidebar')
    <x-sidebar />
@endsection