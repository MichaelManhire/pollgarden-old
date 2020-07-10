const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
require('laravel-mix-purgecss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    })
    .purgeCss({
        content: [path.join(__dirname, 'resources/views/**/*.php')],
        whitelist: [
            'bg-green-100',
            'text-green-800',
            'bg-blue-100',
            'text-blue-800',
            'bg-yellow-100',
            'text-yellow-800',
            'bg-teal-100',
            'text-teal-800',
            'bg-red-100',
            'text-red-800',
            'bg-pink-100',
            'text-pink-800',
            'bg-orange-100',
            'text-orange-800',
            'bg-gray-100',
            'text-gray-800',
        ],
    })

if (mix.inProduction()) {
    mix.version()
}
