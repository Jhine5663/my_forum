<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Game 2D Forum')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;500;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #bfdbfe 0%, #e0f2fe 100%);
            color: #1e293b;
        }
        .pixel-font { font-family: 'Press Start 2P', cursive; }
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 #bfdbfe;
            background: rgba(219, 234, 254, 0.95);
            backdrop-filter: blur(8px);
            border: 2px solid #93c5fd;
            border-radius: 10px;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 8px; }
        .sidebar::-webkit-scrollbar-track { background: #bfdbfe; }
        .sidebar::-webkit-scrollbar-thumb { background-color: #3b82f6; border-radius: 4px; }
        .active-nav-link { position: relative; }
        .active-nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background: #3b82f6;
            animation: pulse 2s infinite;
        }
        .game-card {
            transition: all 0.4s ease;
            transform-style: preserve-3d;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #93c5fd;
            border-radius: 10px;
            backdrop-filter: blur(4px);
        }
        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.08);
        }
        .pixel-border {
            border: 3px solid #93c5fd;
            box-shadow: 6px 6px 0 rgba(147, 197, 253, 0.2);
        }
        .pixel-btn {
            position: relative;
            background: #60a5fa;
            border: 2px solid #93c5fd;
            border-radius: 6px;
            padding: 8px 16px;
            color: #ffffff;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .pixel-btn:hover {
            background: #3b82f6;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
        }
        @keyframes pulse {
            0% { opacity: 0.7; }
            50% { opacity: 1; }
            100% { opacity: 0.7; }
        }
        .glow-text {
            text-shadow: 0 0 4px rgba(59, 130, 246, 0.2);
        }
        .retro-bg {
            background: repeating-linear-gradient(
                0deg, #d1e7ff, #d1e7ff 3px, #e0f2fe 3px, #e0f2fe 6px
            );
        }
        .search-bar {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #93c5fd;
            border-radius: 9999px;
            padding: 8px 16px;
            transition: all 0.3s ease;
            color: #1e293b;
        }
        .search-bar:focus {
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.2);
            border-color: #3b82f6;
        }
        .search-bar::placeholder {
            color: #6b7280;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    @include('components.header')
    <div class="md:hidden bg-white/80 px-4 py-3 border-b border-blue-200">
        <div class="relative">
            <input type="text" placeholder="Search games..." class="search-bar w-full py-2 px-4 focus:outline-none">
            <button class="absolute right-3 top-2 text-blue-600 hover:text-blue-800">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="flex flex-1 container mx-auto px-6 py-8">
        @include('components.notification')
        <aside class="hidden md:block w-80 mr-6 sticky top-6 sidebar">
            <div class="p-4">
                <h3 class="font-bold text-lg mb-4 pixel-font text-blue-800 glow-text">Diễn đàn Game 2D</h3>
                @include('components.sidebar')
            </div>
        </aside>
        <main class="flex-1">
            @yield('content')
        </main>
    </div>
    @include('components.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0) scale(1)";
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.game-card').forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "translateY(20px) scale(0.98)";
                card.style.transition = "all 0.5s ease";
                observer.observe(card);
            });
        });
    </script>
</body>
</html>