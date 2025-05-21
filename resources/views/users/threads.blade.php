@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Chủ đề của bạn</h2>

    @if ($threads->isEmpty())
        <p>Bạn chưa tạo chủ đề nào.</p>
    @else
        <ul>
            @foreach ($threads as $thread)
                <li class="bg-white p-4 mb-4 rounded shadow">
                    <a href="{{ route('threads.show', $thread->id) }}" class="text-blue-600 font-semibold hover:underline">
                        {{ $thread->title }}
                    </a>
                    <p class="text-sm text-gray-500">Ngày đăng: {{ $thread->created_at->format('d/m/Y') }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
