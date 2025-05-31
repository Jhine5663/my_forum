<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Game 2D Forum - Auth')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;500;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #bfdbfe 0%, #e0f2fe 100%);
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pixel-font { font-family: 'Press Start 2P', cursive; }
        .auth-container {
            background: rgba(255, 255, 255, 0.9);
            border: 3px solid #93c5fd;
            border-radius: 12px;
            box-shadow: 6px 6px 0 rgba(147, 197, 253, 0.2);
            backdrop-filter: blur(6px);
            padding: 2.5rem;
            max-width: 500px;
            width: 100%;
            animation: slideIn 0.5s ease;
            margin: 0 auto;
        }
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            width: 100%;
        }
        .pixel-btn {
            position: relative;
            background: #60a5fa;
            border: 2px solid #93c5fd;
            border-radius: 6px;
            padding: 10px 20px;
            color: #ffffff;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .pixel-btn:hover {
            background: #3b82f6;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }
        .auth-input {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #93c5fd;
            border-radius: 6px;
            padding: 10px 14px;
            color: #1e293b;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .auth-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.2);
        }
        .auth-input::placeholder {
            color: #6b7280;
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .glow-text {
            text-shadow: 0 0 4px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8 flex justify-center">
        @include('components.notification')
        <div class="auth-container">
            <h2 class="text-2xl font-bold text-center pixel-font text-blue-900 glow-text mb-6">
                @yield('auth-title', 'Welcome to Game 2D Forum')
            </h2>
            @yield('auth-content')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.auth-container').forEach(container => {
                container.style.opacity = "0";
                container.style.transform = "translateY(20px)";
                container.style.transition = "all 0.5s ease";
                observer.observe(container);
            });
        });
    </script>
</body>
</html>