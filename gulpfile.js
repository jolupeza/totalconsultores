'use strict';

var gulp = require('gulp'),
  clean = require('gulp-clean'),
  compass = require('gulp-compass'),
  cssnano = require('gulp-cssnano'),
  gulpif = require('gulp-if'),
  inject = require('gulp-inject'),
  livereload = require('gulp-livereload'),
  useref = require('gulp-useref'),
  uglify = require('gulp-uglify'),
  uncss = require('gulp-uncss');

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

gulp.task('uncss', ['compress'], function () {
  return gulp.src('./wp-content/themes/totalconsultores/css/style.min.css')
            .pipe(uncss({
              html: ['./app/index.html', './app/about.html', './app/proyectos.html']
            }))
            .pipe(gulp.dest('./wp-content/themes/totalconsultores/css'));
});

// Comprime los archivos CSS y JS enlazados en el index.html y los minifica
gulp.task('compress', function () {
  gulp.src('./app/*.html')
    .pipe(useref())
    .pipe(gulpif('*.js', uglify()))
    .pipe(gulpif('*.css', cssnano()))
    .pipe(gulp.dest('./wp-content/themes/totalconsultores'))
});

// Copia el contenido de los estáticos de index.html al directorio de producción sin tags de comentarios
gulp.task('copy', function () {
  gulp.src('./app/images/**')
    .pipe(gulp.dest('./wp-content/themes/totalconsultores/images'))
  gulp.src('./app/fonts/**')
    .pipe(gulp.dest('./wp-content/themes/totalconsultores/fonts'))
  gulp.src('./bower_components/bootstrap/dist/fonts/**')
    .pipe(gulp.dest('./wp-content/themes/totalconsultores/fonts'))
});

gulp.task('cleanwp', function () {
  return gulp.src([
    'wp-content/themes/totalconsultores/images/',
    'wp-content/themes/totalconsultores/fonts/',
    'wp-content/themes/totalconsultores/css/style.min.css',
    'wp-content/themes/totalconsultores/js/vendor.min.js'
  ], {read: false})
  .pipe(clean());
});

gulp.task('watch', function(){
  livereload.listen()
  gulp.watch(['./app/**/*.html'], ['html'])
  gulp.watch(paths.compass, ['compass', 'inject'])
  gulp.watch(['./app/js/**/*.js'], ['inject'])
  // gulp.watch(['./app/js/**/*.js'], ['jshint', 'inject'])
  // gulp.watch(['./bower.json'], ['wiredep'])
})

gulp.task('del', ['cleanwp']);
gulp.task('build', ['uncss', 'copy']);
