import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/css/customer/dashboard.css',
                'resources/js/customer/dashboard.js',
                'resources/css/auth.css',
            ],
            refresh: true,
        }),
    ],
});
