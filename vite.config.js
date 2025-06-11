import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Hoặc '0.0.0.0' để lắng nghe trên tất cả các địa chỉ IP
        // Nếu bạn muốn chỉ định cổng, thêm:
        // port: 5173, // Cổng mặc định của Vite, có thể thay đổi nếu cần
        hmr: {
            host: '192.168.1.5', // Địa chỉ IP Wi-Fi của máy chủ 
        },
    },
});
