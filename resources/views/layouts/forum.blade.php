@extends('layouts.app')
@section('content')
    <div class="flex flex-1 container mx-auto px-4 py-6">
        @include('components.notification')
        {{-- Sidebar hiện đã được xử lý trong layouts.app.blade.php --}}
        <main class="flex-1">
            @yield('forum-content')
        </main>
    </div>
@endsection