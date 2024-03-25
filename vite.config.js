import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// 1. just import vue
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        // 2. add this single vue() function and boom
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
