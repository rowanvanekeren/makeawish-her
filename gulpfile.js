const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var gulp = require('gulp'),
    php = require('gulp-connect-php');

gulp.task('serve', function() {
    php.server({
        base: './public'
    });
});

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

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js')
       .task('serve')
       .browserSync({
       		proxy: 'localhost:8000'
       });
});
