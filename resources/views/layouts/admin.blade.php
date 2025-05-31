<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Game 2D Forum</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .pixel-font { font-family: 'Press Start 2P', cursive; }
        .glow-text { text-shadow: 0 0 10px rgba(59, 130, 246, 0.5); }
        .game-card { transition: transform 0.2s; }
        .game-card:hover { transform: scale(1.02); box-shadow: 0 0 15px rgba(59, 130, 246, 0.3); }
        .pixel-btn { background-image: linear-gradient(to right, #3b82f6, #60a5fa); }
        .pixel-btn:hover { background-image: linear-gradient(to right, #2563eb, #3b82f6); }
    </style>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-blue-200 text-gray-600">
    <x-header />
    <div class="container mx-auto px-4 py-6 flex">
        <aside class="w-64 bg-green-300 p-4 rounded-lg shadow-md border border-blue-500/20 mr-4">
            <h2 class="text-lg font-bold pixel-font text-blue-700 glow-text mb-4">Admin Menu</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="text-blue-700 hover:underline">Bảng điều khiển</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="text-blue-700 hover:underline">Người dùng</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="text-blue-700 hover:underline">Danh mục</a></li>
                <li><a href="{{ route('admin.threads.index') }}" class="text-blue-700 hover:underline">Chủ đề</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="text-blue-700 hover:underline">Bài viết</a></li>
                <li><a href="{{ route('admin.replies.index') }}" class="text-blue-700 hover:underline">Bình luận</a></li>
            </ul>
        </aside>
        <main class="flex-1">
            <x-notification />
            @yield('admin-content')
        </main>
    </div>
    <x-footer />
</body>
</html>