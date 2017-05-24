'use strict';

var gulp = require('gulp'),
  compass = require('gulp-compass'),
  inject = require('gulp-inject'),
  livereload = require('gulp-livereload');

var paths = {
  compass: ['./app/sass/**/*.scss']
}

// Pre-procesa archivos SASS a CSS y recarga los cambios
gulp.task('compass', function () {
  gulp.src(paths.compass)
    .pipe(compass({
      css: './app/css/',
      sass: './app/sass/',
      image: './app/images/'
    }))
    .pipe(gulp.dest('./app/css'))
    .pipe(livereload());
});

// Recarga el navegador cuando hay cambios en el HTML
gulp.task('html', function () {
  gulp.src(['./app/*.html'])
    .pipe(livereload());
});

// Busca en las carpetas de estilos y javascript los archivos que hayamos creado
// para inyectarlos en el default.html
gulp.task('inject', function () {
  var target = gulp.src('./app/*.html');

  return target.pipe(inject(gulp.src('./app/css/**/*.css', {read: false}), {relative: true}))
    .pipe(inject(gulp.src('./app/js/**/*.js', {read: false}), {relative: true}))
    .pipe(gulp.dest('./app/'));
});

gulp.task('watch', function(){
  livereload.listen()
  gulp.watch(['./app/**/*.html'], ['html'])
  gulp.watch(paths.compass, ['compass', 'inject'])
  gulp.watch(['./app/js/**/*.js'], ['inject'])
  // gulp.watch(['./app/js/**/*.js'], ['jshint', 'inject'])
  // gulp.watch(['./bower.json'], ['wiredep'])
})
