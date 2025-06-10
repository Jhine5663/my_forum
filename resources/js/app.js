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


document.addEventListener('DOMContentLoaded', function() {

    /*
    |--------------------------------------------------------------------------
    | Global/Common Scripts (Áp dụng cho toàn bộ ứng dụng)
    |--------------------------------------------------------------------------
    */

    // Back to top button
    const backToTopButton = document.getElementById('back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
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

    // Intersection Observer cho game-card (hiệu ứng fade-in khi cuộn)
    const gameCards = document.querySelectorAll('.game-card');
    if (gameCards.length > 0) {
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0) scale(1)";
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        gameCards.forEach(card => {
            card.style.opacity = "0";
            card.style.transform = "translateY(20px) scale(0.98)";
            card.style.transition = "all 0.5s ease";
            observer.observe(card);
        });
    }

    // Script để cập nhật năm bản quyền tự động (đặt ở đây vì nó là script global)
    const yearSpan = document.getElementById("year");
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }


    /*
    |--------------------------------------------------------------------------
    | Forum Specific Scripts (Giao diện người dùng diễn đàn)
    |--------------------------------------------------------------------------
    */

    // Mobile menu toggle (cho Header của Forum)
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Tab switching (cho các tab điều hướng trong Forum)
    const tabs = document.querySelectorAll('[role="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => {
                t.classList.remove('active-tab');
                t.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                t.classList.remove('text-blue-500');
                t.style.borderBottomColor = '';
            });
            tab.classList.add('active-tab');
            tab.classList.remove('text-gray-500');
            tab.classList.add('text-blue-500');
            tab.style.borderBottomColor = '#4299e1';
        });
    });

    // Simulate loading more posts/threads (có thể thay thế bằng pagination của Laravel)
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


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Specific Scripts (Giao diện quản trị viên)
    |--------------------------------------------------------------------------
    */

    // Toggle sidebar (Desktop và Mobile)
    const toggleSidebar = document.getElementById('toggle-sidebar'); // Nút desktop toggle
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle'); // Nút mobile mở
    const mobileSidebarClose = document.getElementById('mobile-sidebar-close'); // Nút mobile đóng
    const sidebar = document.getElementById('sidebar');
    const contentArea = document.getElementById('content-area');

    // Desktop sidebar toggle
    if (toggleSidebar && sidebar && contentArea) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            contentArea.classList.toggle('content-expanded');
            contentArea.classList.toggle('content-collapsed');
        });
    }

    // Mobile sidebar toggle (open)
    if (mobileSidebarToggle && sidebar) {
        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.add('sidebar-open');
        });
    }

    // Mobile sidebar close
    if (mobileSidebarClose && sidebar) {
        mobileSidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
        });
    }

    // User dropdown menu (Admin header)
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Ngăn sự kiện click lan ra document
            userMenu.classList.toggle('hidden');
        });
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
    
    // Simulate chart loading (Nếu Người dùng Chart.js hoặc tương tự, hãy tích hợp ở đây)
    console.log('Admin panel loaded');


    /*
    |--------------------------------------------------------------------------
    | Auth Specific Scripts (Giao diện đăng nhập/đăng ký)
    |--------------------------------------------------------------------------
    */

    // Global function to toggle password visibility (đặt global để có thể gọi từ onclick trong Blade)
    window.togglePassword = function(inputId, eyeIconId) {
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

    // Script Animation cho Auth Container
    const authContainers = document.querySelectorAll('.auth-container');
    if (authContainers.length > 0) {
        const authObserverOptions = { threshold: 0.1 };
        const authObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                    authObserver.unobserve(entry.target);
                }
            });
        }, authObserverOptions);
        authContainers.forEach(container => {
            container.style.opacity = "0";
            container.style.transform = "translateY(20px)";
            container.style.transition = "all 0.5s ease";
            authObserver.observe(container);
        });
    }

    // Script cho Toggle buttons login/register (slider)
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const slider = document.getElementById('slider');

    if (loginBtn && registerBtn && slider) {
        const updateSliderPosition = () => {
            // Kiểm tra xem route hiện tại có phải là login hay register không
            // và điều chỉnh vị trí slider cho phù hợp
            // (request()->routeIs('login') và request()->routeIs('register') được kiểm tra trong Blade)
            if (loginBtn.classList.contains('active')) {
                slider.classList.remove('right');
            } else if (registerBtn.classList.contains('active')) {
                slider.classList.add('right');
            }
        };
        // Cập nhật vị trí slider khi tải trang
        updateSliderPosition();

        // Lưu ý: Các nút này giờ sẽ là <a> tag chuyển trang, không còn xử lý ẩn/hiện form bằng JS
        // nên không cần event listener click trực tiếp ở đây để chuyển form.
        // Logic `window.location.href='{{ route('login') }}'` sẽ nằm trong Blade.
    }
        /*
    |--------------------------------------------------------------------------
    | Header User Dropdown (for Desktop & Mobile)
    |--------------------------------------------------------------------------
    */
    const userDropdownButton = document.getElementById('user-dropdown-button');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');

    if (userDropdownButton && userDropdownMenu) {
        userDropdownButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Ngăn sự kiện click lan ra document
            userDropdownMenu.classList.toggle('hidden');
        });

        // Đóng dropdown khi click ra ngoài
        document.addEventListener('click', (e) => {
            if (!userDropdownMenu.contains(e.target) && !userDropdownButton.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }
}); // Kết thúc document.addEventListener('DOMContentLoaded')