@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold pixel-font text-blue-900 glow-text mb-6">Hồ sơ của {{ $user->user_name }}</h1>
        <div class="bg-white/90 p-6 rounded-lg shadow-md border border-[#93c5fd] mb-6">
            <p class="text-gray-800 text-lg">Email: {{ $user->email }}</p>
            <p class="text-gray-800 text-lg">Tham gia: {{ $user->created_at->format('d/m/Y') }}</p>
            @if(Auth::id() == $user->id)
                <a href="{{ route('profile.edit') }}" class="pixel-btn mt-4 inline-block">Chỉnh sửa hồ sơ</a>
            @endif
        </div>
        <h2 class="text-2xl font-bold pixel-font text-blue-900 glow-text mb-6">Chủ đề của bạn</h2>
        @if($user->threads->isEmpty())
            <p class="text-gray-600 text-lg">Bạn chưa tạo chủ đề nào.</p>
        @else
            <div class="space-y-6">
                @foreach($user->threads as $thread)
                    <x-thread-card :thread="$thread" />
                @endforeach
            </div>
        @endif
    </div>
@endsection