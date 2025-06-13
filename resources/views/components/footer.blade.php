<footer class="footer-dark-bg footer-text-color py-8 mt-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- Cột 1: Giới thiệu --}}
            <div>
                <h3 class="text-lg font-bold mb-4 flex items-center footer-heading-color">
                    <i class="fas fa-gamepad mr-2 avatar-icon-color"></i>
                    Game 2D Forum
                </h3>
                <p class="text-sm">Cộng đồng dành cho những người đam mê phát triển và chơi game 2D. Nơi chia sẻ kiến thức, kinh nghiệm và đam mê.</p>
            </div>

            {{-- Cột 2: Liên kết --}}
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Liên kết</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('forum.index') }}" class="footer-link-color">Trang chủ</a></li>
                    <li><a href="{{ route('forum.threads.index') }}" class="footer-link-color">Diễn đàn</a></li>
                    {{-- Các link khác --}}
                </ul>
            </div>

            {{-- Cột 3: Hỗ trợ --}}
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Hỗ trợ</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="footer-link-color">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="footer-link-color">Quy định diễn đàn</a></li>
                    <li><a href="#" class="footer-link-color">Liên hệ quản trị</a></li>
                </ul>
            </div>

            {{-- Cột 4: Kết nối & Newsletter --}}
            <div>
                <h4 class="font-bold mb-4 footer-heading-color">Kết nối</h4>
                <div class="flex space-x-4 mb-4">
                    <a href="#" aria-label="Facebook của chúng tôi" class="footer-social-icon-bg hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    {{-- Các icon mạng xã hội khác --}}
                </div>
                <p class="text-sm">Đăng ký nhận tin mới nhất</p>
                
                {{-- FORM NEWSLETTER ĐÃ CẢI TIẾN --}}
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-2 flex">
                    @csrf
                    <label for="newsletter-email" class="sr-only">Email</label> {{-- Thêm label cho accessibility --}}
                    <input
                        type="email"
                        name="email"
                        id="newsletter-email"
                        placeholder="Email của bạn"
                        class="footer-input px-3 py-2 rounded-l focus:outline-none w-full"
                        required
                    >
                    <button type="submit" aria-label="Đăng ký nhận tin" class="footer-subscribe-btn px-4 py-2 rounded-r">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-[#00569E] mt-8 pt-6 text-center text-sm">
            <p>© <span id="year"></span> Game 2D Forum. All rights reserved.</p>
        </div>
    </div>
</footer>

<button id="back-to-top" class="fixed bottom-6 right-6 back-to-top-btn w-12 h-12 rounded-full shadow-lg flex items-center justify-center hidden">
    <i class="fas fa-arrow-up"></i>
</button>