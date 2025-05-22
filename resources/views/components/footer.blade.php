<footer class="bg-gray-900 text-gray-300 py-8 border-t border-blue-500/20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold pixel-font text-blue-400 glow-text mb-4">Về chúng tôi</h3>
                <p class="text-sm">Game 2D Forum là cộng đồng dành cho các fan của game 2D. Tham gia để chia sẻ kinh nghiệm, mẹo chơi và kết nối với những người chơi khác!</p>
            </div>
            <div>
                <h3 class="text-lg font-bold pixel-font text-blue-400 glow-text mb-4">Liên kết nhanh</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('forum.index') }}" class="hover:text-blue-400">Trang chủ</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 1]) }}" class="hover:text-blue-400">Danh mục</a></li>
                    <li><a href="{{ route('profile.show') }}" class="hover:text-blue-400">Hồ sơ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold pixel-font text-blue-400 glow-text mb-4">Hỗ trợ</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-400">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-400">Liên hệ</a></li>
                    <li><a href="#" class="hover:text-blue-400">Điều khoản</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold pixel-font text-blue-400 glow-text mb-4">Kết nối</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-400 hover:text-blue-600"><i class="fab fa-discord text-xl"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600"><i class="fab fa-github text-xl"></i></a>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} Game 2D Forum. All rights reserved.</p>
        </div>
    </div>
</footer>