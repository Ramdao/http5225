import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Main CSS file (with Tailwind)
                'resources/css/styles.css', // Add the new styles.css file here
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
