let defaultColors = require('tailwindcss/defaultConfig').theme.colors

module.exports = {
    plugins: [require('@tailwindcss/custom-forms')],
    purge: [
        './resources/**/*.php',
        './resources/**/*.css',
        './resources/**/*.js',
    ],
    theme: {
        container: {
            center: true,
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
