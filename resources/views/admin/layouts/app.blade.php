<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.layouts.header')
    <div class="flex">
        @include('admin.layouts.sidebar')
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>