@props([
    'reply',
])
<div class="bg-gray-800 p-3 rounded-lg border border-blue-500/20">
    <p class="text-white text-sm">{{ \Illuminate\Support\Str::limit($reply->content, 80) }}</p>
    <p class="text-xs text-gray-400">
        Bình luận bởi {{ $reply->user->user_name }} vào {{ $reply->created_at->format('d/m/Y H:i') }}
    </p>
</div>