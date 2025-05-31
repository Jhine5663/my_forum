<footer class="bg-white/80 text-gray-800 py-10 border-t border-[#93c5fd] shadow-md backdrop-filter backdrop-blur-sm">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <h3 class="text-2xl font-bold pixel-font text-blue-900 glow-text mb-4">Về chúng tôi</h3>
                <p class="text-base">Game 2D Forum là cộng đồng dành cho các fan của game 2D. Tham gia để chia sẻ kinh nghiệm, mẹo chơi và kết nối với những người chơi khác!</p>
            </div>
            <div>
                <h3 class="text-2xl font-bold pixel-font text-blue-900 glow-text mb-4">Liên kết nhanh</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('forum.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-base">Trang chủ</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 1]) }}" class="text-blue-600 hover:text-blue-800 hover:underline text-base">Danh mục</a></li>
                    <li><a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-base">Hồ sơ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-2xl font-bold pixel-font text-blue-900 glow-text mb-4">Hỗ trợ</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-blue-600 hover:text-blue-800 hover:underline text-base">FAQ</a></li>
                    <li><a href="#" class="text-blue-600 hover:text-blue-800 hover:underline text-base">Liên hệ</a></li>
                    <li><a href="#" class="text-blue-600 hover:text-blue-800 hover:underline text-base">Điều khoản</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-2xl font-bold pixel-font text-blue-900 glow-text mb-4">Kết nối</h3>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-600 hover:text-blue-800 transform hover:scale-110 transition-transform"><i class="fab fa-discord text-2xl"></i></a>
                    <a href="#" class="text-blue-600 hover:text-blue-800 transform hover:scale-110 transition-transform"><i class="fab fa-twitter text-2xl"></i></a>
                    <a href="#" class="text-blue-600 hover:text-blue-800 transform hover:scale-110 transition-transform"><i class="fab fa-github text-2xl"></i></a>
                </div>
            </div>
        </div>
        <div class="mt-10 text-center text-base text-gray-700">
            <p>© {{ date('Y') }} Game 2D Forum. All rights reserved.</p>
        </div>
    </div>
</footer>