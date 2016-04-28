var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
       .scripts([
       		'libs/jquery-2.2.3.min.js',
       		'libs/select2.min.js'
       	], './public/js/libs.js')
       .styles([
       		'libs/select2.min.css'
       	], './public/css/libs.css');
});
