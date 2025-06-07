<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '2D Game Hub - Diễn đàn game 2D')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <meta name="description" content="@yield('meta_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">

    <meta name="keywords" content="@yield('meta_keywords', 'game 2D, indie game, lập trình game, thiết kế game, 2D Game Hub')">

    <meta property="og:title" content="@yield('og_title', '2D Game Hub - Diễn đàn game 2D')">
    <meta property="og:description" content="@yield('og_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">
    <meta property="og:image" content="@yield('og_image', asset('images/default_forum_og_image.png'))"> 
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website"> 

    <meta name="twitter:card" content="summary_large_image">
    {{-- <meta name="twitter:site" content="@yourtwitterhandle"> --}}
    {{-- <meta name="twitter:creator" content="@yourtwitterhandle"> --}}
    <meta name="twitter:title" content="@yield('og_title', '2D Game Hub - Diễn đàn game 2D')">
    <meta name="twitter:description" content="@yield('og_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/default_forum_og_image.png'))">

</head>
<body class="bg-gray-100 font-sans text-gray-900 min-h-screen flex flex-col">
    <x-header />

    <main class="flex-1">
        @yield('content') 
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>