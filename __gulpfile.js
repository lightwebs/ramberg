'use strict';

/**
 * Define your paths and variables here
 */
var options = {
	sassFiles: [
		{
			src: './resources/assets/sass/**/*.scss',
			dest: './assets/css/frontend',
			outputStyle: 'compressed',
			suffix: '.min'
		}
	],
	jsFiles: [
		{
			src: './resources/assets/javascripts/frontend/**/*.js',
			dest: './assets/js/frontend/',
			mangle: true,
			suffix: '.min'
		},
		{
			src: './resources/assets/javascripts/backend/**/*.js',
			dest: './assets/js/backend/',
			mangle: true,
			suffix: '.min'
		}
	]
};

var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var notify = require('gulp-notify');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function() {
	for(var i=0;i<options.sassFiles.length;++i) {
		var sassFile = options.sassFiles[i];

		gulp.src(sassFile.src)
			.pipe(sass({outputStyle: sassFile.outputStyle || 'compressed'}).on('error', sass.logError))
			.pipe(rename({suffix: sassFile.suffix || '.min'}))
			.pipe(autoprefixer({
				browsers: ["> 0%"],
				cascade: false
			}))
			.pipe(gulp.dest(sassFile.dest))
			.pipe(notify("Sass compiled!"));
	}
});

gulp.task('js', function() {
	for(var i=0;i<options.jsFiles.length;++i) {
		var jsFile = options.jsFiles[i];

		gulp.src(jsFile.src)
            .pipe(uglify({mangle: jsFile.mangle || true}).on('error', function(uglify) {
                console.error(uglify.message);
                this.emit('end');
            }))
			.pipe(rename({suffix: jsFile.suffix || '.min'}))
			.pipe(gulp.dest(jsFile.dest))
			.pipe(notify("Javascript compiled!"));
	}
});

gulp.task('watch', function() {
	for(var i=0;i<options.sassFiles.length;++i) {
		var sassFile = options.sassFiles[i];

		gulp.watch(sassFile.src, ['sass']);
	}

	for(var i=0;i<options.jsFiles.length;++i) {
		var jsFile = options.jsFiles[i];

		gulp.watch(jsFile.src, ['js']);
	}
})

gulp.task('watch:sass', function () {
	for(var i=0;i<options.sassFiles.length;++i) {
		var sassFile = options.sassFiles[i];

		gulp.watch(sassFile.src, ['sass']);
	}
});

gulp.task('watch:js', function() {
	for(var i=0;i<options.jsFiles.length;++i) {
		var jsFile = options.jsFiles[i];

		gulp.watch(jsFile.src, ['js']);
	}
});
