var gulp = require('gulp'),
    cleanCSS = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify');

gulp.task('styles', function () {
    return gulp.src(['./css/*.css', '!./css/*.min.css'])
        .pipe(cleanCSS({
            keepSpecialComments: 1,
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});

gulp.task('scripts', function () {
    return gulp.src(['./js/*.js', '!./js/*.min.js'])
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(function (file) {
            return file.base;
        }));
});

gulp.task('watch', function () {
    gulp.watch(['./css/*.css', '!./css/*.min.css'], ['styles']);
    gulp.watch(['./js/*.js', '!./js/*.min.js'], ['scripts']);
});

gulp.task('default', gulp.series('styles', 'scripts'));
