<footer class="bg-gray-800 text-white py-8 mt-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <i class="fas fa-gamepad mr-2"></i> Game 2D Forum
                </h3>
                <p class="text-gray-400 text-sm">Cộng đồng dành cho những người đam mê phát triển và chơi game 2D. Nơi chia sẻ kiến thức, kinh nghiệm và đam mê.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Liên kết</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('forum.index') }}" class="hover:text-white">Trang chủ</a></li>
                    <li><a href="{{ route('forum.threads.index') }}" class="hover:text-white">Diễn đàn</a></li>
                    <li><a href="#" class="hover:text-white">Game mới</a></li>
                    <li><a href="#" class="hover:text-white">Hướng dẫn</a></li>
                    <li><a href="#" class="hover:text-white">Tài nguyên</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Hỗ trợ</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="hover:text-white">Hướng dẫn sử dụng</a></li>
                    <li><a href="#" class="hover:text-white">Quy định diễn đàn</a></li>
                    <li><a href="#" class="hover:text-white">Liên hệ quản trị</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kết nối</h4>
                <div class="flex space-x-4 mb-4">
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-blue-400 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-red-500 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-purple-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-discord"></i>
                    </a>
                </div>
                <p class="text-gray-400 text-sm">Đăng ký nhận tin mới nhất</p>
                <div class="mt-2 flex">
                    <input type="email" placeholder="Email của bạn" class="bg-gray-700 text-white px-3 py-2 rounded-l focus:outline-none w-full">
                    <button class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-r">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
            <p class="text-gray-500 text-sm">© <span id="year"></span> Game 2D Forum. All rights reserved.</p>
        </div>
    </div>
</footer>

<button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center hidden">
    <i class="fas fa-arrow-up"></i>
</button>
