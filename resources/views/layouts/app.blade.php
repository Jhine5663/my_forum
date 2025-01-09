<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Forum</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <header class="p-4 bg-gray-200">
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div>
                    <a href="/" class="text-white text-lg font-bold">Trang chủ</a>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <!-- Hiển thị khi chưa đăng nhập -->
                        <a href="{{ route('login') }}" class="text-white px-4">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="text-white px-4">Đăng ký</a>

                    @endguest
        
                    @auth
                        <!-- Hiển thị khi đã đăng nhập -->
                        <span class="text-white px-4">Xin chào, {{ Auth::user()->user_name }}</span>
                        <a href="/profile" class="text-white px-4">Hồ sơ</a>
                        <a href="/users" class="text-white px-4">Danh sách người Dùng</a>
                        <a href="/categories" class="text-white px-4">Danh sách chủ đề</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button class="text-white px-4">Log Out</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
        
    </header>

    <div class="justify-center h-screen">
        @yield('content')
    </div>

</body>
</html>
