import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/boot.css',
                'resources/js/app.js',
                'resources/js/boot.js',
                'resources/js/shutdown.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
