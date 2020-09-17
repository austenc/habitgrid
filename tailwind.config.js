let colors = require('tailwindcss/lib/flagged/uniformColorPalette').default
    .theme.colors

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
                primary: colors.purple,
            },
            spacing: {
                '1/2': '50%',
            },
        },
    },
}
