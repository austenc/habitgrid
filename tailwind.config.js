let defaultColors = require('tailwindcss/defaultConfig').theme.colors

module.exports = {
    experimental: 'all',
    plugins: [require('@tailwindcss/custom-forms')],
    purge: [
        'app/**/*.php',
        './resources/**/*.php',
        './resources/**/*.css',
        './resources/**/*.js',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                default: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '4rem',
            },
        },
        extend: {
            colors: {
                primary: defaultColors.purple,
            },
            spacing: {
                '1.5': '0.325rem',
            },
        },
    },
}
