var gulp = require('gulp'),
    cleanCSS = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass');


var css_files = [
    './style.css',
    './rtl.css',
    './gutenberg.css',
    './css/*.css',
    '!./css/*.min.css',
    './includes/styles/**/*.css',
    '!./includes/styles/**/*.min.css'
];

var styles_sass_files = [
    './includes/styles/**/*.scss'
];

var main_sass_file = [
    './css/sass/*.scss'
];

var js_files = [
    './js/*.js',
    '!js/**/*.min.js'
];

var version = '7.8.0';

gulp.task('styles',  () => {
    return gulp.src(css_files, {allowEmpty: true})
        .pipe(cleanCSS({
            specialComments: 1,
            level: 1,
            rebase: false
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});


gulp.task('main-style', () => {
    return gulp.src(['./style.css', './gutenberg.css'], {allowEmpty: true})
        .pipe(cleanCSS({
            specialComments: 1,
            level: 1,
            rebase: false
        }))
        .pipe(rename({suffix: '-' + version + '.min'}))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});
 
gulp.task('scripts', function () {
    return gulp.src(js_files, {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});

gulp.task('styles-sass', function () {
    return gulp.src(styles_sass_files)
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});

gulp.task('main-sass', function () {
    return gulp.src(main_sass_file)
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest('./'));
});


gulp.task('watch-sass', function () {
    gulp.watch(styles_sass_files, gulp.series('styles-sass'));
});


gulp.task('ws', function () {
    gulp.watch(styles_sass_files, gulp.series('styles-sass'));
});


gulp.task('watch', function () {
    gulp.watch(styles_sass_files, gulp.series('styles-sass'));
    gulp.watch(css_files, gulp.series('styles'));
    gulp.watch(js_files, gulp.series('scripts'));
});


gulp.task('default', gulp.series('styles', 'main-style', 'scripts', 'styles-sass', 'main-sass'));
