@extends('layouts.app')
@section('content')
    <div class="flex flex-1 container mx-auto px-4 py-6">
        @include('components.notification')
        {{-- <aside class="hidden lg:block w-80 bg-gray-800 text-gray-300 rounded-lg shadow-md mr-6 h-fit sticky top-6 sidebar overflow-y-auto border border-blue-500/20" style="max-height: calc(100vh - 100px)">
            <div class="p-4">
                <h3 class="font-bold text-lg mb-4 text-white pixel-font text-blue-400 glow-text">Diễn đàn Game 2D</h3>
                @include('components.sidebar')
            </div>
        </aside> --}}
        <main class="flex-1">
            @yield('forum-content')
        </main>
    </div>
@endsection