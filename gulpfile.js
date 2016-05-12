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
    mix.sass([
    		'materialize.scss',
    		'app.scss',
    	], './public/css/app.css')
       .styles([
       		'libs/select2.css',
          'libs/materialize-tags.min.css',
          'libs/jquery.fancybox.css',
       	], './public/css/libs.css')
       .scripts([
       		'libs/jquery-2.2.3.min.js',
       		'libs/materialize.min.js',
       		'libs/select2.min.js',
       		'libs/dropzone.js',
          'libs/materialize-tags.js',
          'libs/typeahead.bundle.js',
          'libs/jquery.fancybox.js',
          'libs/moment.js',
       	], './public/js/libs.js')
       	.scripts([
       		'helpers.js',
       	], './public/js/app.js')
});
