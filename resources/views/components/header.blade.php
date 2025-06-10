<header class="gradient-bg text-white shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-gamepad text-2xl"></i>
                <h1 class="text-2xl font-bold">
                    <a href="{{ route('forum.index') }}">Game 2D Forum</a> 
                </h1>
            </div>

            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('forum.index') }}" class="hover:text-blue-300 font-medium">Trang chủ</a>
                <a href="{{ route('forum.threads.index') }}" class="hover:text-blue-300 font-medium">Diễn đàn</a>
                <a href="#" class="hover:text-blue-300 font-medium">Game mới</a>
                <a href="#" class="hover:text-blue-300 font-medium">Hướng dẫn</a>
                <a href="#" class="hover:text-blue-300 font-medium">Tài nguyên</a>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                {{-- Thanh tìm kiếm --}}
                <div class="relative">
                    <input type="text" placeholder="Tìm kiếm..."
                        class="bg-gray-700 text-white px-4 py-1 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </button>
                </div>

                @guest
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-600 px-4 py-1 rounded-full text-sm font-medium">Đăng nhập</a>
                @else
                    <a href="{{ route('profile.show') }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->user_name }}"
                                class="w-9 h-9 rounded-full object-cover">
                        @else
                            <i class="fas fa-user-circle text-lg"></i> 
                        @endif
                    </a>

                    {{-- Dropdown menu cho người dùng đăng nhập --}}
                    <div class="relative">
                        <button id="user-dropdown-button"
                            class="flex items-center space-x-2 focus:outline-none bg-blue-500 hover:bg-blue-600 px-4 py-1 rounded-full text-sm font-medium">
                            <span>{{ Str::limit(Auth::user()->user_name, 10) }}</span> 
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div id="user-dropdown-menu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden border border-gray-200">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Hồ sơ
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Cài đặt
                            </a>

                            @if (Auth::user()->is_admin)
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 font-medium">
                                    <i class="fas fa-shield-alt mr-2"></i> Trang Admin
                                </a>
                            @endif

                            <div class="border-t border-gray-200 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
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
                <input type="text" placeholder="Tìm kiếm..."
                    class="w-full bg-gray-700 text-white px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            @guest
                <a href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-full text-sm font-medium text-center">
                    Đăng nhập
                </a>
            @else
                {{-- Menu user cho mobile --}}
                <div class="flex flex-col space-y-1">
                    <a href="{{ route('profile.show') }}" class="text-white hover:text-blue-300 px-4 py-2">
                        <i class="fas fa-user mr-2"></i> Hồ sơ
                    </a>
                    <a href="{{ route('profile.edit') }}" class="text-white hover:text-blue-300 px-4 py-2">
                        <i class="fas fa-cog mr-2"></i> Cài đặt
                    </a>
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-blue-300 hover:text-blue-200 font-medium px-4 py-2">
                            <i class="fas fa-shield-alt mr-2"></i> Trang Admin
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left text-white hover:text-red-300 px-4 py-2">
                            <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</header>
