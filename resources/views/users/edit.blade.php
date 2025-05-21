@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Chỉnh sửa hồ sơ</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="user_name" class="block font-semibold">Tên người dùng:</label>
            <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}"
                class="w-full p-2 border rounded">
            @error('user_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full p-2 border rounded">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection
