import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
        'node_modules/preline/dist/*.js',
    ],

    theme: {
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        extend: {
            colors: {
                darkPrimary: '#06101C',
                hoverPrimary: '#593084',
                primary: '#A855F7',
                secondary: '#3A3A3A',
                accent: '#A9A9A9',
                dark: '#121212',
                textLight: '#F1F5F9',
                warning: '#8B3A00',
                highlight: '#585858',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('preline/plugin'),
    ],
};
