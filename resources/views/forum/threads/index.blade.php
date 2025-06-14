@extends('layouts.forum')

@section('title', 'Tất Cả Chủ đề | Game 2D Forum - Diễn đàn game 2D')
@section('meta_description', 'Danh sách các chủ đề thảo luận mới nhất về game 2D và lập trình game.')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-800 glow-text mb-6 text-center">
            Các Chủ đề Mới nhất
        </h1>

        @auth
            <div class="mb-6 text-center">
                <a href="{{ route('forum.threads.create') }}"
                   class="btn-pixel bg-[#090979] hover:bg-[#00D4FF] text-white font-bold py-3 px-6 rounded-lg inline-flex items-center space-x-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tạo chủ đề mới</span>
                </a>
            </div>
        @endauth

        @if ($threads->isEmpty())
            <div class="bg-white p-4 mb-4 shadow-md rounded-lg border border-gray-200">
                <p class="text-gray-600 text-center">Chưa có chủ đề nào được tạo. Hãy là người đầu tiên tạo một chủ đề!</p>
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

@endsection