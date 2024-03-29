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
    define: {
        // Define Vue feature flags for production build
        // __VUE_PROD_DEVTOOLS__: false, // Disable Vue Devtools
        // __VUE_OPTIONS_API__: true, // Enable Vue 3 Options API
        // __VUE_PROD_DEVTOOLS__: false, // Disable Vue Devtools in production
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false, // Disable hydration mismatch details
        // Add other feature flags as needed
      },
});
