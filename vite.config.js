import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'node_modules/bootstrap/dist/css/bootstrap.min.css',  // Add Bootstrap CSS
                'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', // Add Bootstrap JS
            ],
            refresh: true,
        }),
    ],
});
