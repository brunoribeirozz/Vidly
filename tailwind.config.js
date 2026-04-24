import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'aurora-vibrant': '#8B32F4',
                'aurora-deep': '#5320A6',
                'aurora-light': '#F3F3F3',
                'aurora-dark': '#0E0D0D',
                fontFamily: {
                    sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                },
            },
        },

        plugins: [forms],
    },
}
