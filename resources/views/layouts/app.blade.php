<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game 2D Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;500;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0f172a;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(30, 58, 138, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(220, 38, 38, 0.15) 0%, transparent 20%);
        }
        
        .pixel-font {
            font-family: 'Press Start 2P', cursive;
        }
        
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: #4b5563 #1f2937;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background-color: #4b5563;
            border-radius: 4px;
        }
        
        .active-nav-link {
            position: relative;
        }
        
        .active-nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #3b82f6;
            animation: pulse 2s infinite;
        }
        
        .game-card {
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }
        
        .game-card:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
        
        .pixel-border {
            border: 4px solid #3b82f6;
            box-shadow: 8px 8px 0 rgba(30, 58, 138, 0.5);
        }
        
        .pixel-btn {
            position: relative;
            overflow: hidden;
        }
        
        .pixel-btn::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(45deg, #3b82f6, #10b981, #3b82f6);
            background-size: 200% 200%;
            z-index: -1;
            opacity: 0;
            transition: 0.5s;
        }
        
        .pixel-btn:hover::before {
            opacity: 1;
            animation: gradient 3s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes pulse {
            0% { opacity: 0.7; }
            50% { opacity: 1; }
            100% { opacity: 0.7; }
        }
        
        .glow-text {
            text-shadow: 0 0 5px rgba(59, 130, 246, 0.7);
        }
        
        .retro-bg {
            background: repeating-linear-gradient(
                0deg,
                #1e293b,
                #1e293b 2px,
                #1e1b4b 2px,
                #1e1b4b 4px
            );
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header/Navigation -->
    @include('layouts.header')
    
    <!-- Mobile Search (hidden on larger screens) -->
    <div class="md:hidden bg-gray-800 px-4 py-2 border-b border-blue-500/20">
        <div class="relative">
            <input 
                type="text" 
                placeholder="Search games..." 
                class="w-full py-2 px-4 rounded-full bg-gray-700 text-white focus:outline-none border border-blue-500/30"
            >
            <button class="absolute right-3 top-2 text-gray-400 hover:text-blue-400">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="flex flex-1 container mx-auto px-4 py-6">
        <!-- Sidebar -->
        @include('components.sidebar')
        <!-- Main Content Area -->
        @yield('content')
        
    </div>
    <!-- Footer -->
    @include('layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle mobile menu
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Simulate user login (for demo purposes)
            const loginDemo = document.getElementById('login-demo');
            const guestControls = document.getElementById('guest-controls');
            const userControls = document.getElementById('user-controls');
            
            if (loginDemo && guestControls && userControls) {
                loginDemo.addEventListener('click', function(e) {
                    e.preventDefault();
                    guestControls.classList.add('hidden');
                    userControls.classList.remove('hidden');
                });
            }
            
            // Add animation to game cards on scroll
            const observerOptions = {
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.game-card').forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "translateY(20px)";
                card.style.transition = "all 0.5s ease";
                observer.observe(card);
            });
        });
    </script>
</body>
</html>