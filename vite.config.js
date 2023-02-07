import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import i18n from 'laravel-vue-i18n/vite';



export default defineConfig({
    plugins: [
        vue(),
        i18n(),
        laravel([
            'resources/sass/app.scss',
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
