    <!-- Header/Navigation -->
    <header class="bg-gray-900 text-white shadow-lg border-b border-blue-500/20">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="flex items-center group">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-md flex items-center justify-center mr-3 transform group-hover:rotate-12 transition">
                            <i class="fas fa-gamepad text-xl"></i>
                        </div>
                        <span class="text-xl font-bold pixel-font text-blue-400 glow-text">GAME 2D</span>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-md mx-4">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search games, topics..."
                            class="w-full py-2 px-4 rounded-full bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30">
                        <button class="absolute right-3 top-2 text-gray-400 hover:text-blue-400 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- User Controls -->
                <div class="flex items-center space-x-4">
                    <!-- Guest -->
                    @guest
                        <div>
                            <a href="{{ route('login') }}"
                                class="px-3 py-1 rounded hover:bg-gray-700 transition border border-blue-500/30 hover:border-blue-500/50">Đăng Nhập</a>
                            <a href="{{ route('register') }}"
                                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-full transition pixel-btn">
                                <span class="relative">Đăng Ký</span>
                            </a>
                        </div>
                    @endguest
                    <!-- Authenticated User -->
                    @auth
                        <div class="relative">
                            <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                    <span>{{ strtoupper(substr(Auth::user()->user_name, 0, 2)) }}</span>
                                </div>
                                <span class="hidden md:inline">{{ Auth::user()->user_name }}</span>
                                <i class="fas fa-chevron-down text-xs hidden md:inline"></i>
                            </button>

                            <!-- Dropdown -->
                            <div id="userDropdownMenu"
                                class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-blue-500/20 hidden">
                                <a href="/profile" class="block px-4 py-2 text-sm hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-400"></i> Hồ sơ
                                </a>
                                <a href="/settings" class="block px-4 py-2 text-sm hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-cog mr-2 text-blue-400"></i> Settings
                                </a>
                                <div class="border-t border-gray-700 my-1"></div>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm hover:bg-gray-700 flex items-center focus:outline-none focus:ring-0 appearance-none bg-transparent text-white">
                                        <i class="fas fa-sign-out-alt mr-2 text-red-400"></i> Đăng Xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    <!-- Dropdown Script -->
                    <script>
                        const dropdownBtn = document.getElementById('userDropdownBtn');
                        const dropdownMenu = document.getElementById('userDropdownMenu');

                        dropdownBtn.addEventListener('click', () => {
                            dropdownMenu.classList.toggle('hidden');
                        });

                        // Đóng dropdown khi click ra ngoài
                        document.addEventListener('click', function(e) {
                            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                dropdownMenu.classList.add('hidden');
                            }
                        });
                    </script>


                </div>
            </div>
        </div>
    </header>
