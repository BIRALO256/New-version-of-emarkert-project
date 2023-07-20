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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        // screens: {
        //     // 'sm': '599px',
        //     // => @media (min-width: 576px) { ... }
      
        //     // 'md': '960px',
        //     // // => @media (min-width: 960px) { ... }
      
        //     // 'lg': '1440px',
        //     // // => @media (min-width: 1440px) { ... }
        //   },
    },

    plugins: [forms, typography],
};
