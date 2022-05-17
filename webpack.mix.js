const { css } = require('laravel-mix');
const mix = require('laravel-mix');

mix.webpackConfig({
    stats: {
        children: true,
    },
});

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
    .sass('resources/sass/app.scss', 'public/css');

mix.css('resources/css/own.css', 'public/css')
    css('resources/css/layout.css','public/css');

mix.css('resources/css/welcome.css', 'public/css');

