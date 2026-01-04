// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css'],  // Zorg dat dit klopt
            refresh: true,
        }),
        tailwindcss(),  // Tailwind plugin voor Vite
    ],
});
