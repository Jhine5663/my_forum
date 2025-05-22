@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-6xl font-bold pixel-font text-blue-400 glow-text mb-4">404</h1>
        <p class="text-2xl text-white mb-4">Trang bạn tìm kiếm không tồn tại.</p>
        <a href="{{ route('forum.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded pixel-btn">Trở về trang chủ</a>
    </div>
@endsection