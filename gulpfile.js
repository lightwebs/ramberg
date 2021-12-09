var gulp = require('gulp');
var concat = require('gulp-concat');
var browserSync = require('browser-sync');
var sass = require('gulp-sass');
var csso = require('gulp-csso');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var maps = require('gulp-sourcemaps');
var fileinclude  = require('gulp-file-include');


// Generate file using fileInclude
// gulp.task('fileinclude', function() {
//   return gulp.src(['app/html/*.html'])
//     .pipe(fileinclude({
//       prefix: '@@',
//       basepath: '@file'
//     }))
//     .pipe(gulp.dest('app/'))
//     .pipe(browserSync.stream());
// });

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function () {
  return gulp.src(['resources/assets/sass/frontend/*.scss'])
    .pipe(sass({
      outputStyle: 'nested',
      precision: 10,
      onError: console.error.bind(console, 'Sass error:')
    }))

    // Minify the file
    .pipe(csso())
    .pipe(gulp.dest("assets/css/frontend/"))
    .pipe(browserSync.stream());
});

gulp.task("concatScripts", function() {
  return gulp.src([
    // 'node_modules/jquery/dist/jquery.min.js',
    // 'node_modules/bootstrap/dist/js/bootstrap.min.js',
    // 'node_modules/popper.js',
    'assets/js/frontend/slick.js',
    'assets/js/frontend/main.js',
  ])
    .pipe(maps.init())
    .pipe(concat('plugins.js'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('assets/js/frontend'))
    .pipe(browserSync.stream());
});

gulp.task("minifyScripts", ["concatScripts"], function() {
  return gulp.src("assets/js/frontend/plugins.js")
    .pipe(rename('plugins.min.js'))
});

// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function () {

    browserSync.init({
        proxy: "http://localhost/ramberg"
  });

  gulp.watch(['resources/assets/sass/frontend/*.scss','resources/assets/sass/frontend/*/*.scss'], ['sass']);
  gulp.watch(['assets/js/frontend/*.js'], ['concatScripts']);
  gulp.watch("*.php").on('change', browserSync.reload);
});

gulp.task('default', ['minifyScripts', 'serve']);