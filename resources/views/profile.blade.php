@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-auto">
    <div class="bg-white p-8 rounded-lg shadow-lg h-screen">
        <div class="flex items-center mb-6">
            <img src="" alt="Avatar" class="w-24 h-24 rounded-full mr-4">
            <div>       
                <p><strong>{{ Auth::user()->user_name }}</strong> </p>
                <p><strong>{{ Auth::user()->email }}:</strong> </p>
            </div>
        </div>

        <div class="mb-6">
            <a href="/profile/edit-profile">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">Chỉnh sửa thông tin</button>
            </a>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Bài viết đã tạo</h2>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Chủ đề đã tạo</h2>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Phản hồi đã tạo</h2>
        </div>
    </div>
</div>
@endsection



