@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex gap-6">
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white p-4 shadow-lg rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">📌 Thể Loại</h2>
        <ul class="space-y-3">
            @foreach ($categories as $category)
                <li>
                    <a href="#" 
                       class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-100 rounded-md transition">
                        {{ $category->name }} 
                        <span class="text-sm text-gray-500">({{ $category->threads->count() }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Nội dung chính -->
    <main class="w-3/4 space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">📝 Diễn Đàn Những Câu Truyện Chưa Được Kể</h1>
            
            @auth
                <a href="{{ route('threads.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                   + Tạo Chủ Đề Mới
                </a>
            @endauth
        </div>
        

        <!-- Danh sách chủ đề mới nhất -->
        <div class="bg-white p-5 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">🔥 Chủ Đề Mới Nhất</h2>
            <ul class="divide-y divide-gray-300">
                @forelse ($latestThreads as $thread)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                <a href="{{ route('threads.show', $thread->id) }}" class="hover:text-blue-600">{{ $thread->title }}</a>
                            </h3>                            
                            <p class="text-sm text-gray-500">📁 {{ $thread->category->name }} - ✍ {{ $thread->user->user_name }}</p>
                        </div>
                        <span class="text-gray-500 text-sm">{{ $thread->created_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <p class="text-gray-500">😞 Chưa có chủ đề nào.</p>
                @endforelse
            </ul>
        </div>

        <!-- Danh sách chủ đề theo thể loại -->
        @foreach ($categories as $category)
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-blue-700">{{ $category->name }}</h2>
                <div class="bg-white p-5 rounded-lg shadow-lg">
                    @forelse ($category->threads->take(5) as $thread)
                        <div class="border-b pb-3 mb-3 last:border-none last:mb-0">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <a href="{{ route('threads.show', $thread->id) }}" class="hover:text-blue-600">{{ $thread->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500">📝 Bài viết: {{ $thread->posts->count() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">🚫 Không có chủ đề nào trong thể loại này.</p>
                    @endforelse
                    @if ($category->threads->count() > 5)
                        <a href="{{ route('categories.threads', $category->id) }}" 
                           class="block mt-3 text-blue-600 hover:underline text-sm">
                           Xem thêm &rarr;
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </main>
</div>
@endsection
