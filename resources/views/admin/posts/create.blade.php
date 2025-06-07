@extends('layouts.admin')

@section('title', 'Tạo Bài viết mới | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tạo Bài viết mới</h1>

        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            {{-- Trường chọn Chủ đề --}}
            <div class="mb-4">
                <label for="thread_id" class="block text-gray-700 text-sm font-bold mb-2">Chọn Chủ đề:</label>
                <select name="thread_id" id="thread_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">-- Chọn chủ đề --</option>
                    @foreach($threads as $thread)
                        <option value="{{ $thread->id }}" {{ old('thread_id', $selectedThread->id ?? '') == $thread->id ? 'selected' : '' }}>
                            {{ Str::limit($thread->title, 50) }} (Tạo bởi: {{ $thread->user->user_name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('thread_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trường chọn Người đăng (Admin có thể đăng thay mặt người khác) --}}
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Người đăng:</label>
                <select name="user_id" id="user_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">-- Chọn người đăng --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', Auth::id()) == $user->id ? 'selected' : '' }}>
                            {{ $user->user_name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Nội dung Bài viết:</label>
                <x-form-textarea id="content" name="content" rows="10" placeholder="Viết nội dung bài viết..." required>{{ old('content') }}</x-form-textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-form-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tạo Bài viết
                </x-form-button>
                <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Hủy</a>
            </div>
        </form>
    </div>
@endsection