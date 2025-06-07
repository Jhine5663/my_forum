<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Game 2D Forum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
</head>
<body class="bg-gray-100 text-gray-800 font-sans"> 
    <div id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-white text-gray-800 shadow-lg z-50"> 
        <div class="p-4 flex items-center justify-between border-b border-gray-200"> 
            <div class="flex items-center">
                <i class="fas fa-gamepad text-2xl text-blue-600"></i> 
                <span class="logo-text ml-3 text-xl font-bold">Game 2D Forum</span>
            </div>
            <button id="toggle-sidebar" class="text-gray-600 hover:text-blue-600 md:block hidden"> 
                <i class="fas fa-bars"></i>
            </button>
            <button id="mobile-sidebar-close" class="text-gray-600 hover:text-blue-600 md:hidden block"> 
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="p-4">
            <div class="flex items-center mb-6">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://via.placeholder.com/40/e0f2fe/1e3c72?text=Admin' }}" alt="{{ Auth::user()->user_name }}" class="rounded-full w-10 h-10">
                <div class="sidebar-text ml-3">
                    <div class="font-medium">{{ Auth::user()->user_name }}</div>
                    <div class="text-xs text-gray-600">Quản trị viên</div>
                </div>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.dashboard') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text ml-3">Bảng điều khiển</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.users.*') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text ml-3">Quản lý thành viên</span>
                </a>
                <a href="{{ route('admin.threads.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.threads.*') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-comments"></i>
                    <span class="sidebar-text ml-3">Quản lý chủ đề</span>
                </a>
                <a href="{{ route('admin.posts.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.posts.*') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-file-alt"></i> 
                    <span class="sidebar-text ml-3">Quản lý bài viết</span>
                </a>
                <a href="{{ route('admin.replies.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.replies.*') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-reply-all"></i> 
                    <span class="sidebar-text ml-3">Quản lý bình luận</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.categories.*') ? 'active-nav' : 'text-gray-800' }}">
                    <i class="fas fa-tags"></i>
                    <span class="sidebar-text ml-3">Danh mục</span>
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 text-gray-800">
                    <i class="fas fa-gamepad"></i>
                    <span class="sidebar-text ml-3">Quản lý game</span> 
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 text-gray-800">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="sidebar-text ml-3">Sự kiện</span> 
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 text-gray-800">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text ml-3">Cài đặt</span>
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 text-gray-800">
                    <i class="fas fa-chart-line"></i>
                    <span class="sidebar-text ml-3">Thống kê</span>
                </a>
            </nav>
        </div>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-gray-200"> 
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-red-100 text-red-600 w-full text-left"> {{-- Nút logout rõ hơn --}}
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="sidebar-text ml-3">Đăng xuất</span>
                </button>
            </form>
        </div>
    </div>
    
    <div id="content-area" class="content-area min-h-screen md:ml-64 bg-gray-100 p-6"> 
        <header class="bg-white shadow-sm rounded-lg mb-6"> 
            <div class="flex justify-between items-center px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800">Bảng điều khiển</h1> 
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-envelope text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">5</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none text-gray-800">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://via.placeholder.com/40/e0f2fe/1e3c72?text=Admin' }}" alt="{{ Auth::user()->user_name }}" class="w-8 h-8 rounded-full">
                            <span class="hidden md:inline">{{ Auth::user()->user_name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"> {{-- Nền trắng, viền nhạt --}}
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hồ sơ</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cài đặt</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="p-0"> 
            <x-notification /> 
            @yield('admin-content')
        </main>
    </div>

    <script>
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const mobileSidebarClose = document.getElementById('mobile-sidebar-close'); /
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('content-area');
        
        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
                contentArea.classList.toggle('content-expanded');
                contentArea.classList.toggle('content-collapsed');
            });
        }

        if (mobileSidebarToggle) {
            mobileSidebarToggle.addEventListener('click', () => {
                sidebar.classList.add('sidebar-open');
            });
        }

        if (mobileSidebarClose) {
            mobileSidebarClose.addEventListener('click', () => {
                sidebar.classList.remove('sidebar-open');
            });
        }
        
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        
        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation(); 
                userMenu.classList.toggle('hidden');
            });
        }
        
        document.addEventListener('click', (e) => {
            if (userMenu && !userMenu.contains(e.target) && (!userMenuButton || !userMenuButton.contains(e.target))) {
                userMenu.classList.add('hidden');
            }
        });
        
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Admin panel loaded');
        });
    </script>
</body>
</html>