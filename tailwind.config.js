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
        './resources/js/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'image-bled': "url('/resources/images/errors/background.jpg')",
            },
            animation: {
                shake: 'shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both',
                'spin-slow': 'spin 30s linear infinite',
                'spin-slower': 'spin 45s linear infinite',
                'spin-reverse': 'reverse-spin 45s linear infinite',
                'bounce-easy': 'bounce-easy 3s infinite',
            },
            keyframes: {
                shake: {
                    '10%, 90%': { transform: 'translate3d(-1px, 0, 0)' },
                    '20%,80%': { transform: 'translate3d(2px, 0, 0)' },
                    '30%, 50%, 70%': { transform: 'translate3d(-4px, 0, 0)' },
                    '40%, 60%': { transform: 'translate3d(4px, 0, 0)' },
                },
                'reverse-spin': {
                    from: {
                        transform: 'rotate(360deg)'
                    },
                },
                'bounce-easy': {
                    '0%, 100%': {
                        transform: 'translateY(-10%)',
                        'animation-timing-function': 'cubic-bezier(0.9,0,1,1)',
                    },
                    '50%': {
                        transform: 'none',
                        'animation-timing-function': 'cubic-bezier(0,0,0.1,1)',
                    },
                },

            },
            dropShadow: {
                'up-lg': ['0 -10px 8px rgba(0, 0, 0, 0.4)', '0 -10px 8px rgba(0, -4px, 3px, 0.1)'],  //0 10px 8px rgb(0 0 0 / 0.04) //0 4px 3px rgb(0 0 0 / 0.1)
            },
            colors: {
                'primary': {
                    '50': '#eafeff',
                    '100': '#cafbff',
                    '200': '#9cf5ff',
                    '300': '#57ecff',
                    '400': '#0cd7ff',
                    '500': '#00bbea',
                    '600': '#0093c4',
                    '700': '#007ba7',
                    '800': '#0b5d7f',
                    '900': '#0e4e6b',
                    '950': '#02334a',
                },
                'amazon': {
                    '50': '#f1f8f3',
                    '100': '#ddeee1',
                    '200': '#bdddc7',
                    '300': '#91c4a5',
                    '400': '#63a47d',
                    '500': '#3b7a57',
                    '600': '#2f6c4b',
                    '700': '#26563d',
                    '800': '#204533',
                    '900': '#1b392a',
                    '950': '#0e2018',
                },
                'gray': {
                    '50': '#f6f6f6',
                    '100': '#e7e7e7',
                    '200': '#d1d1d1',
                    '300': '#b0b0b0',
                    '400': '#848484',
                    '500': '#6d6d6d',
                    '600': '#5d5d5d',
                    '700': '#4f4f4f',
                    '800': '#454545',
                    '900': '#3d3d3d',
                    '950': '#262626',
                },
                'bittersweet': {
                    '50': '#fff2f1',
                    '100': '#ffe4e1',
                    '200': '#ffccc7',
                    '300': '#ffa8a0',
                    '400': '#ff6f61',
                    '500': '#f84c3b',
                    '600': '#e52f1d',
                    '700': '#c12314',
                    '800': '#a02014',
                    '900': '#842218',
                    '950': '#480d07',
                },
            },
        },
    },

    plugins: [forms, typography, require('tailwind-scrollbar'), require('flowbite/plugin'), require('flowbite-typography'),],
};
