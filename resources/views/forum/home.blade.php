@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Diễn Đàn Những Câu Truyện Chưa Được Kể</h1>

    @foreach ($categories as $category)
        <!-- Thể Loại -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">{{ $category->name }}</h2>
            <div class="bg-white p-4 rounded-lg shadow-md">
                @forelse ($category->threads as $thread)
                    <!-- Chủ Đề -->
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <a href="#" class="hover:text-blue-600">{{ $thread->title }}</a>
                        </h3>
                        <ul class="ml-4 list-disc">
                            @foreach ($thread->posts as $post)
                                <!-- Bài Viết -->
                                <li class="mt-2 text-gray-600">
                                    <p class="font-medium">Bài viết: {{ $post->body }}</p>
                                    <ul class="ml-6 list-disc">
                                        @foreach ($post->replies as $reply)
                                            <!-- Phản Hồi -->
                                            <li class="text-gray-500">
                                                {{ $reply->body }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-gray-500">Không có chủ đề nào trong thể loại này.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection
