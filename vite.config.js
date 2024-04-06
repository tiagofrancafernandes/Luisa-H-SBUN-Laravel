import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        typography,
        forms,
    ],
});
