import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',

        // Blade views
        './resources/views/**/*.blade.php',

        // Livewire PHP (class-based)
        './app/Livewire/**/*.php',
    ],

    safelist: [
        // row backgrounds
        'bg-yellow-100',
        'bg-red-100',

        // badge backgrounds
        'bg-yellow-600',
        'bg-red-600',

        // text
        'text-white',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
