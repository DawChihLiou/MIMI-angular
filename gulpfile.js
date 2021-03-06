var gulp = require('gulp');

var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

// js syntax check with lint
gulp.task('lint', function() {
	return gulp.src('js/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

// compile sass
gulp.task('sass', function() {
	return gulp.src('scss/*.scss')
		.pipe(sass())
		.pipe(gulp.dest('css'));
});

// concatenate and minify script
gulp.task('scripts', function() {
	return gulp.src('js/*.js')
		// .pipe(concat('all.js'))
		// .pipe(gulp.dest('js'))
		.pipe(rename('app.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('js/dest'));
});

// watch file change
gulp.task('watch', function() {
	gulp.watch('js/*.js', ['lint', 'scripts']);
	gulp.watch('scss/*.scss', ['sass']);
})

// set default task
gulp.task('default', ['lint', 'sass', 'scripts', 'watch']);