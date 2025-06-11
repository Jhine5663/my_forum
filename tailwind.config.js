import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                // Thêm màu xanh đậm của bạn
                'dark-blue-text': '#0E3D73', // Tên màu tùy chỉnh của bạn
                // Các màu khác đã sử dụng trong CSS cũng có thể thêm vào đây
                'primary-blue': '#0073D0',
                'accent-yellow': '#FFC857',
                'error-red': '#E21C34',
                'light-gray': '#F4F4F4',
                'medium-gray': '#DBDBDB',
                'dark-green': '#BDE0D1', // Màu xanh lục nhạt
                'bright-orange': '#FF8C42', // Màu cam sáng
            },
            fontFamily: {
                'sans': ['Be Vietnam Pro', 'sans-serif'], // Đảm bảo Be Vietnam Pro là font chính
                'pixel': ['"Press Start 2P"', 'cursive'], // Định nghĩa font pixel
            }
        },
    },
    plugins: [],
};