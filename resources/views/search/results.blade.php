@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Kết quả tìm kiếm cho "{{ request()->query('query') }}"</h1>
        @if($results->isEmpty())
            <p class="text-gray-500">Không tìm thấy kết quả.</p>
        @else
            <div class="space-y-4">
                @foreach($results as $result)
                    @if($result instanceof \App\Models\Thread)
                        <x-thread-card :thread="$result" />
                    @elseif($result instanceof \App\Models\Post)
                        <x-post-card :post="$result" />
                    @elseif($result instanceof \App\Models\User)
                        <div class="bg-gray-800 p-4 rounded-lg border border-blue-500/20 game-card">
                            <a href="{{ route('profile.show', $result) }}" class="text-blue-400 hover:underline">{{ $result->user_name }}</a>
                            <p class="text-sm text-gray-400">Tham gia: {{ $result->created_at->format('d/m/Y') }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
            {{ $results->links() }}
        @endif
    </div>
@endsection