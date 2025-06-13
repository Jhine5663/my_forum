<header class="pixel-tertiary-bg text-white shadow-lg relative ">
    {{-- Lớp phủ gradient mờ --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[rgba(2,0,36,0.8)] to-[rgba(9,9,121,0.8)]"></div>

    <div class="container mx-auto px-4 py-3 relative">
        <div class="flex justify-between items-center">
            {{-- Logo và tiêu đề forum --}}
            <div class="flex items-center space-x-2">
                <i class="fas fa-gamepad text-2xl avatar-icon-color"></i>
                <h1 class="text-2xl font-bold">
                    <a href="{{ route('forum.index') }}" class="avatar-icon-color nav-link-hover">2D Game Hub</a>
                </h1>
            </div>

            {{-- Navigation chính (Desktop) --}}
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('forum.index') }}"
                   class="{{ request()->routeIs('forum.index') ? 'active-nav-link' : 'nav-link-hover' }} font-medium">Trang chủ</a>

                <a href="{{ route('forum.threads.index') }}"
                   class="{{ request()->routeIs('forum.threads.index') ? 'active-nav-link' : 'nav-link-hover' }} font-medium">Diễn đàn</a>

                <a href="#" class="nav-link-hover font-medium">Game mới</a>
                <a href="#" class="nav-link-hover font-medium">Hướng dẫn</a>
                <a href="#" class="nav-link-hover font-medium">Tài nguyên</a>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                {{-- Thanh tìm kiếm --}}
                <div class="relative">
                    <input type="text" placeholder="Tìm kiếm..."
                           class="search-bar pr-10">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 search-bar-icon"
                            aria-label="Nút tìm kiếm">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                @guest
                    <a href="{{ route('login') }}"
                       class="pixel-btn text-sm">Đăng nhập</a>
                @else
                    {{-- Avatar người dùng --}}
                    <a href="{{ route('profile.show') }}" class="block w-9 h-9 rounded-full overflow-hidden border-2 avatar-border">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->user_name }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->user_name) }}&background=0073D0&color=FFFFFF&size=36&bold=true"
                                alt="{{ Auth::user()->user_name }}"
                                class="w-full h-full object-cover">
                        @endif
                    </a>

                    {{-- Dropdown menu cho người dùng đăng nhập --}}
                    {{-- ĐÃ THÊM Z-INDEX CHO CONTAINER CỦA DROPDOWN --}}
                    <div class="relative"> {{-- Thêm z-20 ở đây --}}
                        <button id="user-dropdown-button"
                                class="flex items-center space-x-2 focus:outline-none pixel-btn text-sm"
                                aria-haspopup="true" aria-expanded="false" aria-label="Menu người dùng">
                            <span>{{ Str::limit(Auth::user()->user_name, 10) }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div id="user-dropdown-menu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden border dropdown-menu-border">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm dropdown-item-text dropdown-item-hover-bg
                                {{ request()->routeIs('profile.show') ? 'active-nav-link' : '' }}">
                                <i class="fas fa-user mr-2"></i> Hồ sơ
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm dropdown-item-text dropdown-item-hover-bg
                                {{ request()->routeIs('profile.edit') ? 'active-nav-link' : '' }}">
                                <i class="fas fa-cog mr-2"></i> Cài đặt
                            </a>

                            @if (Auth::user()->is_admin)
                                <div class="border-t dropdown-menu-border my-1"></div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm dropdown-admin-link dropdown-item-hover-bg font-medium
                                    {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'nav-link-hover' }}">
                                    <i class="fas fa-shield-alt mr-2"></i> Trang Admin
                                </a>
                            @endif

                            <div class="border-t dropdown-menu-border my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 dropdown-logout-link">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none" aria-label="Mở menu di động">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div id="mobile-menu" class="hidden md:hidden mobile-menu-dark-bg px-4 py-2 relative">
        <div class="flex flex-col space-y-3">
            <a href="{{ route('forum.index') }}" class="{{ request()->routeIs('forum.index') ? 'active-nav-link' : 'nav-link-hover' }} font-medium">Trang chủ</a>
            <a href="{{ route('forum.threads.index') }}" class="mobile-menu-link {{ request()->routeIs('forum.threads.index') ? 'active-nav-link' : 'nav-link-hover' }} font-medium">Diễn đàn</a>

            <a href="#" class="mobile-menu-link font-medium">Game mới</a>
            <a href="#" class="mobile-menu-link font-medium">Hướng dẫn</a>
            <a href="#" class="mobile-menu-link font-medium">Tài nguyên</a>

            <div class="pt-2 border-t mobile-menu-border-color">
                <input type="text" placeholder="Tìm kiếm..."
                    class="search-bar w-full">
            </div>
            @guest
                <a href="{{ route('login') }}"
                    class="pixel-btn text-sm text-center">Đăng nhập</a>
            @else
                <div class="flex flex-col space-y-1 pt-2 border-t mobile-menu-border-color">
                    <a href="{{ route('profile.show') }}" class="px-4 py-2 mobile-menu-link
                        {{ request()->routeIs('profile.show') ? 'active-nav-link' : 'nav-link-hover' }}">
                        <i class="fas fa-user mr-2"></i> Hồ sơ
                    </a>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 mobile-menu-link
                        {{ request()->routeIs('profile.edit') ? 'active-nav-link' : 'nav-link-hover' }}">
                        <i class="fas fa-cog mr-2"></i> Cài đặt
                    </a>
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 font-medium mobile-menu-link
                            {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'nav-link-hover' }}">
                            <i class="fas fa-shield-alt mr-2"></i> Trang Admin
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 mobile-menu-link">
                            <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</header>