/*
|--------------------------------------------------------------------------
| resources/js/app.js
|--------------------------------------------------------------------------
|
| Đây là tệp JavaScript chính của ứng dụng.
| Nó xử lý các tương tác DOM, các chức năng chung, và các script dành riêng
| cho từng phần của giao diện (forum, admin, auth).
|
*/

import './bootstrap'; // Import các modules bootstrap hoặc global khác nếu có

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Global/Common Scripts (Áp dụng cho toàn bộ ứng dụng)
    |--------------------------------------------------------------------------
    */

    /**
     * Khởi tạo nút "Back to Top"
     */
    const initBackToTopButton = () => {
        const backToTopButton = document.getElementById('back-to-top');
        if (backToTopButton) {
            window.addEventListener('scroll', () => {
                // Thêm/bỏ class 'hidden' để kiểm soát hiển thị
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('hidden');
                } else {
                    backToTopButton.classList.add('hidden');
                }
            });
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    };

    /**
     * Khởi tạo hiệu ứng fade-in cho game-card bằng Intersection Observer.
     * Sử dụng các lớp CSS: `game-card-hidden` (trạng thái ban đầu) và `game-card-visible` (trạng thái sau animation).
     */
    const initGameCardAnimations = () => {
        const gameCards = document.querySelectorAll('.game-card');
        if (gameCards.length > 0) {
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Kích hoạt animation bằng cách thêm lớp `game-card-visible`
                        entry.target.classList.add('game-card-visible');
                        // Đảm bảo loại bỏ lớp `game-card-hidden` nếu bạn dùng nó cho trạng thái ban đầu
                        entry.target.classList.remove('game-card-hidden');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            gameCards.forEach(card => {
                // Thiết lập trạng thái ban đầu cho animation qua lớp CSS
                card.classList.add('game-card-hidden');
                observer.observe(card);
            });
        }
    };

    /**
     * Cập nhật năm bản quyền tự động trong footer
     */
    const updateCopyrightYear = () => {
        const yearSpan = document.getElementById("year");
        if (yearSpan) {
            yearSpan.textContent = new Date().getFullYear();
        }
    };

    /**
     * Hàm chung để xử lý dropdown menu và menu mobile.
     * @param {string} buttonId ID của nút bấm để mở/đóng dropdown/menu
     * @param {string} menuId ID của menu dropdown/menu mobile
     * @param {boolean} [closeOnClickOutside=true] Tùy chọn: có đóng menu khi click ra ngoài không
     */
    const setupToggleMenu = (buttonId, menuId, closeOnClickOutside = true) => {
        const button = document.getElementById(buttonId);
        const menu = document.getElementById(menuId);

        if (button && menu) {
            button.addEventListener('click', (e) => {
                e.stopPropagation(); // Ngăn chặn sự kiện click lan truyền lên document
                const isHidden = menu.classList.toggle('hidden');
                // Cập nhật trạng thái aria-expanded cho khả năng truy cập
                button.setAttribute('aria-expanded', !isHidden);
            });

            if (closeOnClickOutside) {
                document.addEventListener('click', (e) => {
                    // Đóng menu nếu click ra ngoài nút hoặc menu
                    if (!menu.contains(e.target) && !button.contains(e.target)) {
                        if (!menu.classList.contains('hidden')) { // Chỉ đóng nếu nó đang mở
                            menu.classList.add('hidden');
                            button.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            }
        }
    };

    // Khởi tạo các chức năng chung
    initBackToTopButton();
    initGameCardAnimations(); // Kích hoạt animation cho game cards
    updateCopyrightYear();

    // === Thêm dòng này để kích hoạt dropdown người dùng ở header chính ===
    setupToggleMenu('user-dropdown-button', 'user-dropdown-menu');
    // ====================================================================

    /*
    |--------------------------------------------------------------------------
    | Forum Specific Scripts (Giao diện người dùng diễn đàn)
    |--------------------------------------------------------------------------
    */

    /**
     * Khởi tạo chức năng đóng mở menu mobile cho Forum Header
     * Sử dụng hàm `setupToggleMenu` để đồng bộ hóa logic.
     */
    const initForumMobileMenu = () => {
        setupToggleMenu('mobile-menu-button', 'mobile-menu');
    };

    /**
     * Khởi tạo chức năng chuyển đổi tab trong Forum.
     * Đồng bộ với CSS: chỉ thêm/bỏ class 'active-tab' và các class Tailwind.
     */
    const initForumTabSwitching = () => {
        const tabs = document.querySelectorAll('[role="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Xóa trạng thái active của tất cả các tab khác
                tabs.forEach(t => {
                    t.classList.remove('active-tab', 'text-blue-500'); // Xóa màu cũ
                    t.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                });
                // Thêm trạng thái active cho tab hiện tại
                tab.classList.add('active-tab', 'text-blue-500'); // Thêm màu mới đã định nghĩa trong CSS
                tab.classList.remove('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });
        });
    };

    /**
     * Mô phỏng chức năng "Tải thêm bài viết/chủ đề"
     * (Thường sẽ được thay thế bằng Pagination hoặc AJAX request thực tế)
     */
    const initLoadMorePosts = () => {
        const loadMoreButton = document.getElementById('load-more-posts');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', () => {
                loadMoreButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang tải...';
                // Thay thế bằng logic AJAX thực tế để tải thêm bài viết
                setTimeout(() => {
                    alert('Đã tải thêm chủ đề mới!');
                    loadMoreButton.innerHTML = '<i class="fas fa-sync-alt mr-2"></i>Tải thêm chủ đề';
                }, 1500);
            });
        }
    };

    // Khởi tạo các chức năng của Forum
    initForumMobileMenu();
    initForumTabSwitching();
    initLoadMorePosts();


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Specific Scripts (Giao diện quản trị viên)
    |--------------------------------------------------------------------------
    */

    /**
     * Khởi tạo chức năng đóng mở sidebar cho Admin Panel
     */
    const initAdminSidebarToggle = () => {
        const toggleSidebar = document.getElementById('toggle-sidebar'); // Nút desktop toggle
        const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle'); // Nút mobile mở
        const mobileSidebarClose = document.getElementById('mobile-sidebar-close'); // Nút mobile đóng
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('content-area');

        // Toggle sidebar cho desktop
        if (toggleSidebar && sidebar && contentArea) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
                // Đảm bảo chỉ có một trong hai class này được áp dụng
                contentArea.classList.toggle('content-expanded');
                contentArea.classList.toggle('content-collapsed');
            });
        }

        // Mở sidebar cho mobile (sử dụng sidebar-open class)
        if (mobileSidebarToggle && sidebar) {
            mobileSidebarToggle.addEventListener('click', () => {
                sidebar.classList.add('sidebar-open');
            });
        }

        // Đóng sidebar cho mobile
        if (mobileSidebarClose && sidebar) {
            mobileSidebarClose.addEventListener('click', () => {
                sidebar.classList.remove('sidebar-open');
            });
        }
    };

    /**
     * Khởi tạo dropdown menu cho Admin header
     * Sử dụng lại hàm `setupToggleMenu` để đồng bộ hóa logic.
     */
    const initAdminHeaderDropdown = () => {
        setupToggleMenu('user-menu-button', 'user-menu');
    };

    // Khởi tạo các chức năng của Admin Panel
    initAdminSidebarToggle();
    initAdminHeaderDropdown();


    /*
    |--------------------------------------------------------------------------
    | Auth Specific Scripts (Giao diện đăng nhập/đăng ký)
    |--------------------------------------------------------------------------
    */

    /**
     * Chức năng toàn cục để chuyển đổi hiển thị mật khẩu
     * Hàm này được export ra window để có thể gọi trực tiếp từ HTML (onclick)
     * @param {string} inputId ID của trường input mật khẩu
     * @param {string} eyeIconId ID của icon mắt
     */
    window.togglePassword = (inputId, eyeIconId) => {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput && eyeIcon) {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    };

    /**
     * Khởi tạo animation fade-in/slide-up cho Auth container.
     * Sử dụng lớp `slide-in-animation` đã định nghĩa trong CSS.
     */
    const initAuthContainerAnimation = () => {
        const authContainers = document.querySelectorAll('.auth-container');
        if (authContainers.length > 0) {
            authContainers.forEach(container => {
                container.classList.add('slide-in-animation');
            });
        }
    };

    /**
     * Xử lý vị trí slider cho các nút Login/Register
     * (Giả định các nút là thẻ <a> chuyển trang, không xử lý ẩn/hiện form)
     */
    const initAuthToggleButtonSlider = () => {
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');
        const slider = document.getElementById('slider');

        if (loginBtn && registerBtn && slider) {
            // Cập nhật vị trí slider dựa trên class 'active' được thêm vào bởi Blade/route
            const updateSliderPosition = () => {
                if (loginBtn.classList.contains('active')) {
                    slider.classList.remove('right');
                } else if (registerBtn.classList.contains('active')) {
                    slider.classList.add('right');
                }
            };
            updateSliderPosition(); // Chạy khi tải trang
        }
    };

    // Khởi tạo các chức năng của Auth
    initAuthContainerAnimation();
    initAuthToggleButtonSlider();

}); // Kết thúc document.addEventListener('DOMContentLoaded')