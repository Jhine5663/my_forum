@extends('layouts.forum')

@section('title', 'Liên hệ | Diễn đàn Game 2D')

@section('forum-content')
<div class="flex-1 p-6">
    <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-200 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 glow-text mb-6 text-center">Liên hệ với chúng tôi</h1>

        <div class="grid md:grid-cols-2 gap-8">
            {{-- Cột thông tin liên hệ --}}
            <div class="prose prose-lg text-gray-700">
                <p>
                    Chúng tôi luôn sẵn lòng lắng nghe mọi ý kiến đóng góp, thắc mắc, hoặc các cơ hội hợp tác từ bạn. Đừng ngần ngại liên hệ với ban quản trị qua các kênh dưới đây:
                </p>
                <ul class="list-none p-0">
                    <li class="flex items-center mb-4">
                        <i class="fas fa-envelope fa-fw mr-3 text-blue-600"></i>
                        <span>contact@2dgamehub.com</span>
                    </li>
                    <li class="flex items-center mb-4">
                        <i class="fab fa-facebook-f fa-fw mr-3 text-blue-600"></i>
                        <a href="#" class="text-blue-600 hover:underline">fb.com/2DGameHub</a>
                    </li>
                    <li class="flex items-center mb-4">
                        <i class="fab fa-discord fa-fw mr-3 text-blue-600"></i>
                        <a href="#" class="text-blue-600 hover:underline">discord.gg/2DGameHub</a>
                    </li>
                </ul>
                <p>
                    Chúng tôi sẽ cố gắng phản hồi trong thời gian sớm nhất.
                </p>
            </div>

            {{-- Cột form liên hệ --}}
            <div>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tên của bạn:</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Nội dung:</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn-pixel bg-blue-600 hover:bg-blue-700 text-white">
                            Gửi tin nhắn
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection