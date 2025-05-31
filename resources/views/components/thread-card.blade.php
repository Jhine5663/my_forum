@props([
    'thread',
])
<div class="game-card p-6 rounded-lg border border-[#93c5fd]">
    <a href="{{ route('threads.show', $thread) }}" class="text-blue-800 text-xl font-bold hover:underline glow-text">{{ $thread->title }}</a>
    <p class="text-sm text-gray-700 mt-2">
        Đăng bởi {{ $thread->user->user_name }} trong
        <a href="{{ route('categories.show', $thread->category) }}" class="text-blue-600 hover:underline">{{ $thread->category->name }}</a>
        vào {{ $thread->created_at->format('d/m/Y') }}
    </p>
</div>