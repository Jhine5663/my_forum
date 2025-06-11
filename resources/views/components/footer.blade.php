<footer class="footer-dark-bg footer-text-color py-8 mt-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4 flex items-center footer-heading-color">
                    <i class="fas fa-gamepad mr-2 avatar-icon-color"></i> {{-- Icon gamepad vẫn là vàng nhấn --}}
                    Game 2D Forum
                </h3>
                <p class="text-sm">Cộng đồng dành cho những người đam mê phát triển và chơi game 2D. Nơi chia sẻ kiến thức, kinh nghiệm và đam mê.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Liên kết</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('forum.index') }}" class="footer-link-color">Trang chủ</a></li>
                    <li><a href="{{ route('forum.threads.index') }}" class="footer-link-color">Diễn đàn</a></li>
                    <li><a href="#" class="footer-link-color">Game mới</a></li>
                    <li><a href="#" class="footer-link-color">Hướng dẫn</a></li>
                    <li><a href="#" class="footer-link-color">Tài nguyên</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Hỗ trợ</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="footer-link-color">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="footer-link-color">Hướng dẫn sử dụng</a></li>
                    <li><a href="#" class="footer-link-color">Quy định diễn đàn</a></li>
                    <li><a href="#" class="footer-link-color">Liên hệ quản trị</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Kết nối</h4>
                <div class="flex space-x-4 mb-4">
                    <a href="#" class="footer-social-icon-bg hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer-social-icon-bg hover:bg-blue-400 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="footer-social-icon-bg hover:bg-red-500 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="footer-social-icon-bg hover:bg-purple-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-discord"></i>
                    </a>
                </div>
                <p class="text-sm">Đăng ký nhận tin mới nhất</p>
                <div class="mt-2 flex">
                    <input type="email" placeholder="Email của bạn" class="footer-input px-3 py-2 rounded-l focus:outline-none w-full">
                    <button class="footer-subscribe-btn px-3 py-2 rounded-r">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t border-[#00569E] mt-8 pt-6 text-center text-sm"> {{-- Sử dụng màu xanh lam đậm hơn cho đường viền --}}
            <p>© <span id="year"></span> Game 2D Forum. All rights reserved.</p>
        </div>
    </div>
</footer>

<button id="back-to-top" class="fixed bottom-6 right-6 back-to-top-btn w-12 h-12 rounded-full shadow-lg flex items-center justify-center hidden" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Cập nhật năm hiện tại cho footer
    document.getElementById('year').textContent = new Date().getFullYear();

    // Hiển thị/ẩn nút back-to-top
    const backToTopButton = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) { // Hiển thị sau khi cuộn 200px
            backToTopButton.classList.remove('hidden');
        } else {
            backToTopButton.classList.add('hidden');
        }
    });
</script>