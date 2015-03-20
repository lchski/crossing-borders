var gulp  = require('gulp');
var gutil = require('gulp-util');

var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var compass      = require('gulp-compass');
var imagemin     = require('gulp-imagemin');
var minifyCSS    = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

var dev = 'app/assets/';
var pub = 'assets/';

var paths = {
	dev: {
		images:    dev + 'images/*',
		sass:      dev + 'scss',
		sass_all: [dev + 'scss/*', dev + 'scss/**'],
		js:        dev + 'js/*'
	},
	pub: {
		css:    pub + 'css/',
		images: pub + 'img/',
		js:     pub + 'js/'
	}
};

gulp.task('css', function() {
	return gulp.src(paths.dev.sass + '/*.scss')
		.pipe(compass({
			sass:  paths.dev.sass,
			css:   paths.pub.css,
			image: paths.pub.images,
			require: [
				'rgbapng',
				'breakpoint',
				'sass-globbing',
				'compass-normalize'
			],
			bundle_exec: true
		}))
		.on('error', gutil.log)
		.pipe(autoprefixer({
			browser: ['last 2 versions'],
			cascade: false
		}))
		.pipe(minifyCSS())
		.pipe(gulp.dest(paths.pub.css));
});

gulp.task('js', function() {
	return gulp.src(paths.dev.js)
		.pipe(gulp.dest(paths.pub.js));
});

gulp.task('images', function () {
	gulp.src(paths.dev.images)
		.pipe(imagemin())
		.pipe(gulp.dest(paths.pub.images));
});

gulp.task('watch', function() {
	gulp.watch(paths.dev.sass_all, ['css']);
	gulp.watch(paths.dev.js, ['js']);
	gulp.watch(paths.dev.images, ['images']);
});

gulp.task('default', ['css', 'js', 'images']);

gulp.task('serve', ['default', 'watch']);