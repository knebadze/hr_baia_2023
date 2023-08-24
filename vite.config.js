import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import i18n from 'laravel-vue-i18n/vite';



export default defineConfig({
    plugins: [
        vue(),
        i18n(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    esbuild: {
        supported: {
            'top-level-await': true //browsers can handle top-level-await features
        },
    },
});
