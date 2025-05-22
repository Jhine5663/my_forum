@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Hồ sơ của {{ $user->user_name }}</h1>
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20 mb-4">
            <p class="text-white">Email: {{ $user->email }}</p>
            <p class="text-white">Tham gia: {{ $user->created_at->format('d/m/Y') }}</p>
            @if(Auth::id() == $user->id)
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded pixel-btn mt-2 inline-block">Chỉnh sửa hồ sơ</a>
            @endif
        </div>
        <h2 class="text-xl font-bold text-white mb-4">Chủ đề của bạn</h2>
        @if($user->threads->isEmpty())
            <p class="text-gray-500">Bạn chưa tạo chủ đề nào.</p>
        @else
            <div class="space-y-4">
                @foreach($user->threads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>
        @endif
    </div>
@endsection