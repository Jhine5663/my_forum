<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css') <!-- Dùng Tailwind CSS -->
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav>
                <ul>
                    <li class="px-4 py-2 hover:bg-blue-800">
                        <a href="/users">Quản lý Người dùng</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-blue-800">
                        <a href="/categories">Quản lý Thể loại</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-blue-800">
                        <a href="/threads">Quản lý Chủ đề</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-blue-800">
                        <a href="/posts">Quản lý Bài viết</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
