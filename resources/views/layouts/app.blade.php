<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '2D Game Hub - Cộng đồng & Diễn đàn Game 2D')</title>

    {{-- Google Fonts: Be Vietnam Pro cho nội dung tiếng Việt, Press Start 2P cho yếu tố pixel/retro --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Be+Vietnam+Pro:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Font Awesome để sử dụng các icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tệp CSS và JavaScript chính của ứng dụng, được xử lý bởi Vite --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- Meta Tags cho SEO và Open Graph/Twitter Cards --}}
    <meta name="description" content="@yield('meta_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">
    <meta name="keywords" content="@yield('meta_keywords', 'game 2D, indie game, lập trình game, thiết kế game, 2D Game Hub, diễn đàn game')">

    {{-- Open Graph Tags (cho Facebook, LinkedIn, v.v.) --}}
    <meta property="og:title" content="@yield('og_title', '2D Game Hub - Cộng đồng & Diễn đàn Game 2D')">
    <meta property="og:description" content="@yield('og_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">
    <meta property="og:image" content="@yield('og_image', asset('images/default_forum_og_image.png'))">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', '2D Game Hub - Cộng đồng & Diễn đàn Game 2D')">
    <meta name="twitter:description" content="@yield('og_description', 'Cộng đồng game 2D lớn nhất. Thảo luận, chia sẻ và kết nối với những người đam mê game 2D.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/default_forum_og_image.png'))">

</head>
{{-- Thay đổi text-gray-900 thành text-dark-blue-text để đồng bộ với bảng màu --}}
<body class="bg-gray-100 font-sans text-dark-blue-text min-h-screen flex flex-col">
    {{-- Header Blade Component --}}
    <x-header />

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer Blade Component --}}
    <x-footer />

    {{-- Chứa các script JS cụ thể của từng trang nếu cần --}}
    @stack('scripts')
</body>
</html>