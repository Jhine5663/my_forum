<nav class="bg-white/80 shadow-md border-b border-[#93c5fd] backdrop-filter backdrop-blur-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('forum.index') }}" class="text-2xl font-bold pixel-font text-blue-900 glow-text">Game 2D Forum</a>
            </div>
            <div class="hidden md:block flex-1 px-4">
                <form action="{{ route('search.results') }}" method="GET" class="relative max-w-md mx-auto">
                    <input type="text" name="query" placeholder="Tìm kiếm game..." class="search-bar w-full">
                    <button type="submit" class="absolute right-3 top-2 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <button id="userDropdownBtn" class="flex items-center space-x-2 text-blue-900 hover:text-blue-600 focus:outline-none">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span>{{ Auth::user()->user_name }}</span>
                            <i class="fas fa-caret-down"></i>
                        </button>
                        <div id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white/90 rounded-lg shadow-lg hidden z-10 border border-[#93c5fd] backdrop-filter backdrop-blur-sm">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 flex items-center">
                                <i class="fas fa-user mr-2 text-blue-600"></i> Hồ sơ
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 flex items-center">
                                <i class="fas fa-cog mr-2 text-blue-600"></i> Cài đặt
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 flex items-center">
                                    <i class="fas fa-shield-alt mr-2 text-blue-600"></i> Admin
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-100 flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2 text-blue-600"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="pixel-btn">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownBtn = document.getElementById('userDropdownBtn');
        const dropdownMenu = document.getElementById('userDropdownMenu');

        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function () {
            dropdownMenu.classList.add('hidden');
        });
    });
</script>