var gulp        = require('gulp');                  // Gulp!

var uglify      = require('gulp-uglify');           // Uglify javascript
var rename      = require('gulp-rename');           // Rename files
var util        = require('gulp-util');             // Writing stuff
var header      = require('gulp-header');           // Add header to files

var pkg     = require('./package.json');
var banner  = ['/**<%= pkg.name %>',
               '@version v<%= pkg.version %>',
               'Built: ' + util.date() + '',
               '*/',
               ''].join(' ') + '\n';


// task
gulp.task('scripts', function () {
    gulp.src('./js/*.js') // path to your files
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(header(banner, { pkg : pkg }))
        .pipe(gulp.dest('./js/min'));
});


gulp.task('default', ['scripts']);