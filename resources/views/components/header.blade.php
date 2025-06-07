<header class="gradient-bg text-white shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-gamepad text-2xl"></i>
                <h1 class="text-2xl font-bold">Game 2D Forum</h1>
            </div>
            
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('forum.index') }}" class="hover:text-blue-300 font-medium">Trang chủ</a>
                <a href="{{ route('forum.threads.index') }}" class="hover:text-blue-300 font-medium">Diễn đàn</a>
                <a href="#" class="hover:text-blue-300 font-medium">Game mới</a>
                <a href="#" class="hover:text-blue-300 font-medium">Hướng dẫn</a>
                <a href="#" class="hover:text-blue-300 font-medium">Tài nguyên</a>
            </nav>
            
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Tìm kiếm..." class="bg-gray-700 text-white px-4 py-1 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </button>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-1 rounded-full text-sm font-medium">Đăng nhập</a>
                @else
                    <a href="{{ route('profile.show') }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-1 rounded-full text-sm font-medium">{{ Auth::user()->user_name }}</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-1 rounded-full text-sm font-medium">Đăng xuất</button>
                    </form>
                @endguest
            </div>
            
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
    
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800 px-4 py-2">
        <div class="flex flex-col space-y-3">
            <a href="{{ route('forum.index') }}" class="text-white hover:text-blue-300">Trang chủ</a>
            <a href="{{ route('forum.threads.index') }}" class="text-white hover:text-blue-300">Diễn đàn</a>
            <a href="#" class="text-white hover:text-blue-300">Game mới</a>
            <a href="#" class="text-white hover:text-blue-300">Hướng dẫn</a>
            <a href="#" class="text-white hover:text-blue-300">Tài nguyên</a>
            <div class="pt-2 border-t border-gray-700">
                <input type="text" placeholder="Tìm kiếm..." class="w-full bg-gray-700 text-white px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            @guest
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-full text-sm font-medium text-center">Đăng nhập</a>
            @else
                <a href="{{ route('profile.show') }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-full text-sm font-medium text-center">{{ Auth::user()->user_name }}</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-sm font-medium w-full">Đăng xuất</button>
                </form>
            @endguest
        </div>
    </div>
</header>
