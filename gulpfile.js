const elixir = require('laravel-elixir');


var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    image = require('gulp-image');

gulp.task('serve', function() {
    php.server({
        base: './public'
    });
});

gulp.task('image', function () {
  gulp.src('resources/assets/images/*')
    .pipe(image())
    .pipe(gulp.dest('public/images'));
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

elixir(function(mix) {
    mix.sass('app.scss')
       .webpack('app.js')
       .task('serve')
       .task('image')
       .browserSync({
       		proxy: 'localhost:8000'
       });
});
