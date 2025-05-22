@props([
    'thread',
])
<div class="bg-gray-800 p-4 rounded-lg border border-blue-500/20 game-card">
    <a href="{{ route('threads.show', $thread) }}" class="text-blue-400 hover:underline text-lg font-bold">{{ $thread->title }}</a>
    <p class="text-sm text-gray-400">
        Đăng bởi {{ $thread->user->user_name }} trong
        <a href="{{ route('categories.show', $thread->category) }}" class="text-blue-400 hover:underline">{{ $thread->category->name }}</a>
        vào {{ $thread->created_at->format('d/m/Y') }}
    </p>
</div>