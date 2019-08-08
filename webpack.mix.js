const mix = require('laravel-mix');

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

// Home
mix.sass('resources/sass/welcome.scss','public/css');
mix.sass('resources/sass/home.scss','public/css');

// User
mix.sass('resources/sass/users/index.scss','public/css/users');

// Admin
mix.sass('resources/sass/questions/create.scss','public/css/questions');

