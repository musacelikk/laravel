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
                sans: ['DM Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Cormorant Garamond', 'Georgia', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                luxe: {
                    cream: '#f7f3ed',
                    sand: '#ebe4d8',
                    gold: '#c4a35a',
                    'gold-light': '#dcc99a',
                    ink: '#1a1814',
                    charcoal: '#2d2a26',
                    muted: '#8a8278',
                },
            },
        },
    },

    plugins: [forms, typography],
};
