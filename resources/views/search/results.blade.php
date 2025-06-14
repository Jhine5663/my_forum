@extends('layouts.forum')

@section('title', 'Kết quả tìm kiếm cho "' . e($query) . '"')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-800 glow-text mb-6">
            Kết quả tìm kiếm cho: "<span class="text-blue-600">{{ e($query) }}</span>"
        </h1>

        <div class="space-y-8">
            {{-- PHẦN KẾT QUẢ TỪ CHỦ ĐỀ --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-700 border-b-2 border-blue-500 pb-2 mb-4">
                    <i class="fas fa-comments mr-2 text-blue-500"></i> Chủ đề tìm thấy ({{ $threads->count() }})
                </h2>
                @if ($threads->isEmpty())
                    <p class="text-gray-500">Không tìm thấy chủ đề nào phù hợp.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($threads as $thread)
                            {{-- Sử dụng component thread-card có sẵn của bạn --}}
                            <x-thread-card :thread="$thread" />
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- PHẦN KẾT QUẢ TỪ BÀI VIẾT --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-700 border-b-2 border-green-500 pb-2 mb-4">
                    <i class="fas fa-file-alt mr-2 text-green-500"></i> Bài viết tìm thấy ({{ $posts->count() }})
                </h2>
                @if ($posts->isEmpty())
                    <p class="text-gray-500">Không tìm thấy bài viết nào phù hợp.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($posts as $post)
                            <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                                <p class="text-gray-600 text-sm">
                                    <a href="{{ route('users.profile', $post->user) }}" class="font-bold text-blue-600 hover:underline">{{ $post->user->user_name }}</a>
                                    đã viết trong chủ đề
                                    <a href="{{ route('forum.threads.show', $post->thread) }}" class="font-bold text-blue-600 hover:underline">"{{ $post->thread->title }}"</a>
                                </p>
                                <div class="prose prose-sm mt-2 text-gray-800">
                                    {{-- Highlight từ khóa tìm kiếm (tùy chọn nâng cao) --}}
                                    {!! Str::limit(nl2br(e($post->content)), 200) !!}
                                </div>
                                <a href="{{ route('forum.threads.show', $post->thread) }}#post-{{ $post->id }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block">Xem bài viết &rarr;</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection