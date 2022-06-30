import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
    // build: {
    //     rollupOptions: {
    //         output: {
    //             entryFileNames: 'assets/[name].js',
    //             assetFileNames: 'assets/[name][extname]',
    //         },
    //     },
    // },
});
