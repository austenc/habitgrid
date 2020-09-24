const theme = require('tailwindcss/defaultConfig').theme
const colors = require('tailwindcss/lib/flagged/uniformColorPalette').default
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
                primary: colors.blue,
                'cool-gray': {
                    '50': '#f8fafc',
                    '100': '#f1f5f9',
                    '200': '#e2e8f0',
                    '300': '#cfd8e3',
                    '400': '#97a6ba',
                    '500': '#64748b',
                    '600': '#475569',
                    '700': '#364152',
                    '800': '#27303f',
                    '900': '#1a202e',
                },
                'white-50': 'rgba(255, 255, 255, 0.75)',
            },
            spacing: {
                '1/2': '50%',
            },
            fontFamily: {
                marketing: ['Open Sans', ...theme.fontFamily.sans],
                marker: ['Permanent Marker', 'serif'],
            },
        },
    },
}
