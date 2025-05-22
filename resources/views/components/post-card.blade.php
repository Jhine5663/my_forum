@props(['post'])
<div class="bg-gray-800 p-4 rounded-lg border border-blue-500/20 game-card">
    <p class="text-white">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
    <p class="text-sm text-gray-400">
        Đăng bởi {{ $post->user->user_name }} vào {{ $post->created_at->format('d/m/Y') }}
    </p>
</div>