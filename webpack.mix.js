const mix = require('laravel-mix');
const path = require('path');

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
   .vue() // Tambahkan ini agar .vue files bisa diproses
   .sass('resources/sass/app.scss', 'public/css')
   .alias({
        '@': path.resolve('resources/js'),
    });

mix.webpackConfig({
   module: {
      rules: [
         {
               test: /\.vue$/,
               loader: 'vue-loader'
         }
      ]
   }
});