/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'orange-imco': '#d63826',
                'green-imco': '#158ca7',
                'yellow-imco': '#feba11',
                'black-imco': '#152a3a',
                'red-imco': '#ed230d',
                'gray-imco': '#b4c7e7',
                'white-imco': '#f5f5eb',
                'green-ig': '#14647a',
                'green-black-imco':'#152a3a'
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
