import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import tailwindcss from '@tailwindcss/vite'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Tambahkan font outfit dari CSS Anda
                outfit: ['Outfit', 'sans-serif'], 
            },
            colors: {
                // Pindahkan warna dari @theme CSS ke sini
                brand: {
                    500: '#465fff',
                    // ... tambahkan warna brand lain (50, 100, dll) dari file CSS ...
                    25: 'f2f7ff',
                    50: 'ecf3ff',
                    100:'dde9ff',
                    200:'c2d6ff',
                    300:'9cb9ff',
                    400:'7592ff',
                    600:'3641f5',
                    700:'2a31d8',
                    800:'252dae',
                    900:'262e89',
                    950:'161950',
                },
                blue: {
                    25:  'f5fbff',
                    50:  'f0f9ff',
                    100: 'e0f2fe',
                    200: 'b9e6fe',
                    300: '7cd4fd',
                    400: '36bffa',
                    500: '0ba5ec',
                    600: '0086c9',
                    700: '026aa2',
                    800: '065986',
                    900: '0b4a6f',
                    950: '062c41',
                }
                // ... tambahkan warna lain (orange, success, dll) ...
            }
        },
    },

    plugins: [
        tailwindcss(),
    ],
};
