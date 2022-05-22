const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.disableNotifications();

mix.js('resources/js/contactsList_src.js', 'public/js')
    .sass('resources/scss/contactsPage.scss', 'public/css', [])
    .sass('resources/scss/detailCache.scss', 'public/css', [])
    .sass('resources/scss/login.scss', 'public/css', []); //.sourceMaps()

