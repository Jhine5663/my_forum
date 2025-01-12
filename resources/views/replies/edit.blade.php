@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Chỉnh sửa Bình Luận</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('replies.update', $reply) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">Nội Dung</label>
            <textarea id="comment" name="comment" rows="4" class="w-full p-2 border rounded"
                      required>{{ $reply->comment }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Cập Nhật</button>
        <a href="{{ route('replies.index', $reply->post) }}" 
           class="ml-2 bg-gray-500 text-white px-4 py-2 rounded shadow">Hủy</a>
    </form>
</div>
@endsection
