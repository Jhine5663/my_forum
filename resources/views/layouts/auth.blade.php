<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '2D Game Hub - Xác thực')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <meta name="description" content="@yield('meta_description', 'Đăng nhập hoặc đăng ký tài khoản tại 2D Game Hub - Diễn đàn game 2D.')">
    <meta name="keywords" content="@yield('meta_keywords', 'đăng nhập, đăng ký, tài khoản game 2D, forum')">
    <meta property="og:title" content="@yield('og_title', 'Xác thực | 2D Game Hub')">
    <meta property="og:description" content="@yield('og_description', 'Đăng nhập hoặc đăng ký tài khoản tại 2D Game Hub - Diễn đàn game 2D.')">
    <meta property="og:image" content="@yield('og_image', asset('images/default_forum_og_image.png'))">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
</head>
<body class="font-poppins bg-gradient-to-br from-blue-100 via-purple-100 to-white flex items-center justify-center min-h-screen text-gray-800">
    <div class="container mx-auto px-4 py-8 flex justify-center max-w-4xl">
        <x-notification /> 

        <div class="w-full md:flex bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="hidden md:block md:w-1/2 bg-gradient-to-b from-blue-500 to-purple-600 p-8 flex flex-col justify-center items-center text-white">
                <div class="float-animation mb-8">
                    <i class="fas fa-gamepad text-6xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-2">Chào mừng đến với</h3>
                <h2 class="text-3xl font-extrabold mb-4">Diễn đàn Game 2D</h2>
                <p class="text-center text-blue-100">
                    Kết nối với cộng đồng yêu thích game 2D. Chia sẻ, thảo luận và khám phá những tựa game tuyệt vời.
                </p>
                {{-- <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-2 text-blue-200"></i>
                        <span class="text-sm">10,000+ Thành viên</span> 
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-comments mr-2 text-blue-200"></i>
                        <span class="text-sm">5,000+ Bài viết</span> 
                    </div>
                </div> --}}
            </div>
            
            <div class="w-full md:w-1/2 p-8 md:p-10">
                <div class="md:hidden flex justify-center mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-gamepad text-blue-600 text-3xl mr-2"></i>
                        <span class="text-xl font-bold text-blue-600">Diễn đàn Game 2D</span>
                    </div>
                </div>
                
                <div class="mb-8">
                    <div class="toggle-buttons">
                        <div id="slider" class="toggle-slider"></div>
                        <button id="loginBtn" 
                                class="{{ request()->routeIs('login') ? 'active' : '' }}" 
                                onclick="window.location.href='{{ route('login') }}'">Đăng nhập</button>
                        <button id="registerBtn" 
                                class="{{ request()->routeIs('register') ? 'active' : '' }}" 
                                onclick="window.location.href='{{ route('register') }}'">Đăng ký</button>
                    </div>
                </div>
                
                @yield('auth-form-content') 
            </div>
        </div>
    </div>

</body>
</html>