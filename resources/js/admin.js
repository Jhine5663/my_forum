// resources/js/admin.js
document.addEventListener('DOMContentLoaded', () => {

    /* Admin Sidebar Toggle */
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
    const mobileSidebarClose = document.getElementById('mobile-sidebar-close');
    const sidebar = document.getElementById('sidebar');
    const contentArea = document.getElementById('content-area');

    // Desktop toggle
    if (toggleSidebar && sidebar && contentArea) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            contentArea.classList.toggle('content-expanded');
            contentArea.classList.toggle('content-collapsed');
        });
    }

    // Mobile toggle (open)
    if (mobileSidebarToggle && sidebar) {
        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.add('sidebar-open');
        });
    }

    // Mobile close
    if (mobileSidebarClose && sidebar) {
        mobileSidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
        });
    }
    // Close mobile sidebar on outside click
    document.addEventListener('click', (e) => {
        if (sidebar && !sidebar.contains(e.target) && (!mobileSidebarToggle || !mobileSidebarToggle.contains(e.target))) {
            if (sidebar.classList.contains('sidebar-open')) {
                sidebar.classList.remove('sidebar-open');
            }
        }
    });

    /* Admin Header User Dropdown */
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }

    // Console log để xác nhận tải
    console.log('Admin panel JS loaded');
});