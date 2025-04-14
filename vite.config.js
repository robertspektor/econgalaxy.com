import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/galaxy-map.js',
                'resources/js/system-map.js',
                'resources/js/faction-borders.js',
                'resources/js/utils.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
