var del = require('del'),
	gulp = require('gulp'),
	autoprefixer = require('gulp-autoprefixer'),
	concat = require('gulp-concat'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	uglify = require('gulp-uglify'),
	gutil = require('gulp-util'),
	sequence = require('run-sequence'),
	config = require('./gulp-config');

gulp.task('sass', function() {
	return gulp.src(config.scss.src)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: config.scss.outputStyle }).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.scss.dest))
});

gulp.task('app', function() {
	return gulp.src(config.js.src)
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', handleError))
        .pipe(concat(config.js.outputName).on('error', handleError))
        .on('error', handleError)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.js.dest));
});

gulp.task('app-watch', function() {
	gulp.watch(config.watch.scss, ['sass']);
	gulp.watch(config.watch.js, ['app']);
});

gulp.task('default', devTask);
gulp.task('build', buildTask);

function devTask() {
	del(config.del.src).then(function(paths) {
		sequence('sass', 'app', 'app-watch');
	});
}

function buildTask() {
	del(config.del.src).then(function(paths) {
		sequence('sass', 'app');
	});
}

function handleError(error) {
   gutil.log(error.message);
}