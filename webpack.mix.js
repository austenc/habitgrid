const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')

mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('postcss-preset-env')({ stage: 0 }),
])

mix.browserSync({
    proxy: process.env.APP_URL,
    files: ['app/**/*.php', 'resources/views/**/*.php', 'public/**/*.(js|css)'],
})

if (mix.inProduction()) {
    mix.version()
}
