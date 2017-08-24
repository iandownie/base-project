var gulp = require('gulp'),
	sourcemaps = require('gulp-sourcemaps'),
	gutil = require("gulp-util"),
	webpack = require("webpack"),
	sass = require('gulp-sass'),
	browserSync = require('browser-sync').create();

// Static server + watching scss/php files.
gulp.task('serve', ['styles', 'js'], function() {
	browserSync.init({
		proxy: 'njimedia.loc'
	});

	gulp.watch('src/scss/**/*.scss',['styles']);
	gulp.watch('./**/*.php').on('change', browserSync.reload);
	gulp.watch('./**/*.js', ['js']).on('change', browserSync.reload);
});

gulp.task('styles', function() {
	return gulp.src('src/scss/styles.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('assets/css/'))
		.pipe(browserSync.stream());
}); 

var webPackConfig = {
	context: './src/js',
	entry: { 
		main: './app.js' 
	},
	output: {
		path: './assets/js',
		filename: '[name].js'
	}
};


gulp.task('js', function(callback){
	var initialCompile = false;
	webpack(webPackConfig).watch({
		aggregateTimeout: 300,
		poll: true
	}, function (err, stats) {
		browserSync.reload();
		if (!initialCompile) {
			initialCompile = true;
			callback();
		}
	});
});

// Watch task.
gulp.task('default', ['serve']);

