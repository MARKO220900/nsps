const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/livewire/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sky: colors.sky,
                red: colors.red,
                blue: colors.blue,
                Gray: colors.gray,
                greenLine: colors.line,
                yellow: colors.yellow,

            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
