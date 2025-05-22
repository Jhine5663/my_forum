<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Game 2D Forum - Auth')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;500;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0f172a;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(30, 58, 138, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(220, 38, 38, 0.15) 0%, transparent 20%);
        }
        .pixel-font { font-family: 'Press Start 2P', cursive; }
        .pixel-btn { position: relative; overflow: hidden; }
        .pixel-btn::before {
            content: ''; position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px;
            background: linear-gradient(45deg, #3b82f6, #10b981, #3b82f6);
            background-size: 200% 200%; z-index: -1; opacity: 0; transition: 0.5s;
        }
        .pixel-btn:hover::before { opacity: 1; animation: gradient 3s ease infinite; }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .glow-text { text-shadow: 0 0 5px rgba(59, 130, 246, 0.7); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        @include('components.notification')
        @yield('auth-content')
    </div>
</body>
</html>