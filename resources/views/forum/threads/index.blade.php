@extends('layouts.forum')

@section('title', 'Tất Cả Chủ đề | Diễn đàn Game 2D')
@section('meta_description', 'Danh sách các chủ đề thảo luận mới nhất về game 2D và lập trình game.')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold pixel-font text-blue-400 glow-text mb-6 text-center">
            Các Chủ đề Mới nhất
        </h1>

        @auth
            <div class="mb-6 text-center">
                <a href="{{ route('forum.threads.create') }}"
                   class="pixel-btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center space-x-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tạo chủ đề mới</span>
                </a>
            </div>
        @endauth

        @if ($threads->isEmpty())
            <div class="bg-gray-800 p-4 mb-4 shadow-md rounded-lg border border-gray-700">
                <p class="text-gray-400 text-center">Chưa có chủ đề nào được tạo. Hãy là người đầu tiên tạo một chủ đề!</p>
            </div>
        @else
            <div class="space-y-4"> 
                @foreach ($threads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>

            <div class="mt-6">
                {{ $threads->links() }}
            </div>
        @endif
    </div>

    @section('sidebar')
        <x-sidebar />
    @endsection

@endsection