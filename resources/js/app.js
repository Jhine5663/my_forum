import './bootstrap'; 

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
            let isHidden = true; // Lưu trạng thái hiện tại của nút để tránh thao tác DOM thừa

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset > 300;
                if (scrolled && isHidden) {
                    backToTopButton.classList.remove('hidden');
                    isHidden = false;
                } else if (!scrolled && !isHidden) {
                    backToTopButton.classList.add('hidden');
                    isHidden = true;
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
            const observer = new IntersectionObserver((entries, observer) => { // Truyền observer vào callback
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('game-card-visible');
                        entry.target.classList.remove('game-card-hidden');
                        observer.unobserve(entry.target); // Ngừng quan sát sau khi animation được kích hoạt
                    }
                });
            }, observerOptions);

            gameCards.forEach(card => {
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
                e.stopPropagation();
                const isHidden = menu.classList.toggle('hidden');
                button.setAttribute('aria-expanded', !isHidden);
            });

            if (closeOnClickOutside) {
                document.addEventListener('click', (e) => {
                    // Kiểm tra xem click có nằm ngoài cả button và menu không
                    if (!menu.contains(e.target) && !button.contains(e.target)) {
                        if (!menu.classList.contains('hidden')) {
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
    initGameCardAnimations();
    updateCopyrightYear();
    setupToggleMenu('user-dropdown-button', 'user-dropdown-menu');

    /*
    |--------------------------------------------------------------------------
    | Forum Specific Scripts (Giao diện người dùng diễn đàn)
    |--------------------------------------------------------------------------
    */

    /**
     * Khởi tạo chức năng đóng mở menu mobile cho Forum Header
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
                    t.classList.remove('active-tab');
                    // Đảm bảo các lớp màu sắc không liên quan đến active-tab được quản lý tốt
                    // ví dụ: t.classList.add('text-gray-500', 'hover:text-gray-700'); nếu cần
                });
                // Thêm trạng thái active cho tab hiện tại
                tab.classList.add('active-tab');
                // Tùy chỉnh màu sắc dựa vào active-tab trong CSS thay vì thêm/bỏ ở đây
            });
        });
    };

    /**
     * Mô phỏng chức năng "Tải thêm bài viết/chủ đề"
     */
    const initLoadMorePosts = () => {
        const loadMoreButton = document.getElementById('load-more-posts');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', () => {
                loadMoreButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang tải...';
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
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('content-area');
        const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

        // Tải trạng thái sidebar từ localStorage khi load trang
        const loadSidebarState = () => {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true' && window.innerWidth >= 768) { // Chỉ áp dụng cho desktop
                sidebar.classList.add('sidebar-collapsed');
                contentArea.classList.remove('content-expanded');
                contentArea.classList.add('content-collapsed');
            } else { // Đảm bảo trạng thái mặc định cho mobile hoặc khi không có lưu trữ
                sidebar.classList.remove('sidebar-collapsed', 'sidebar-open'); // Đảm bảo mobile sidebar đóng theo mặc định
                contentArea.classList.remove('content-collapsed');
                contentArea.classList.add('content-expanded');
            }
        };

        // Gắn sự kiện khi cửa sổ được tải (để kiểm tra kích thước màn hình ban đầu)
        window.addEventListener('load', loadSidebarState);
        // Gắn sự kiện khi thay đổi kích thước cửa sổ (để xử lý responsive)
        window.addEventListener('resize', loadSidebarState);


        // Toggle sidebar cho desktop
        if (toggleSidebar && sidebar && contentArea) {
            toggleSidebar.addEventListener('click', () => {
                const isCollapsed = sidebar.classList.toggle('sidebar-collapsed');
                contentArea.classList.toggle('content-expanded', !isCollapsed);
                contentArea.classList.toggle('content-collapsed', isCollapsed);
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });
        }

        // Mở sidebar cho mobile (nút menu hamburger ở header mobile)
        if (mobileSidebarToggle && sidebar) {
            mobileSidebarToggle.addEventListener('click', () => {
                sidebar.classList.add('sidebar-open');
            });
        }

        // Đóng sidebar cho mobile (nút X trong sidebar mobile)
        if (mobileSidebarClose && sidebar) {
            mobileSidebarClose.addEventListener('click', () => {
                sidebar.classList.remove('sidebar-open');
            });
        }
    };

    /**
     * Khởi tạo dropdown menu cho Admin header
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
     */
    window.togglePassword = (inputId, eyeIconId) => {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput && eyeIcon) {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('fa-eye-slash', !isPassword);
            eyeIcon.classList.toggle('fa-eye', isPassword);
        }
    };

    /**
     * Khởi tạo animation fade-in/slide-up cho Auth container.
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
     */
    const initAuthToggleButtonSlider = () => {
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');
        const slider = document.getElementById('slider');

        if (loginBtn && registerBtn && slider) {
            const updateSliderPosition = () => {
                if (loginBtn.classList.contains('active')) {
                    slider.classList.remove('right');
                } else if (registerBtn.classList.contains('active')) {
                    slider.classList.add('right');
                }
            };
            updateSliderPosition();
        }
    };

    // Khởi tạo các chức năng của Auth
    initAuthContainerAnimation();
    initAuthToggleButtonSlider();

}); // Kết thúc document.addEventListener('DOMContentLoaded')