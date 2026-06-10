import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0fdfa',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#14b8a6',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                },
                accent: {
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                },
                surface: {
                    50: '#faf9f7',
                    100: '#f3f1ec',
                    200: '#e8e4dc',
                },
            },
            boxShadow: {
                soft: '0 2px 20px -2px rgba(19, 78, 74, 0.08)',
                glow: '0 8px 32px -4px rgba(20, 184, 166, 0.25)',
            },
        },
    },

    plugins: [forms, typography],
};
