'use strict';

let theme       = 'bookshop',
    site_name   = 'bookshop',
    
    gulp        = require( 'gulp' ),
    browsersync = require( "browser-sync" ).create(),
    
    autoLoad    = require( 'gulp-load-plugins' )(),
    del         = require( 'del' ),
    
    wpPot       = require( 'gulp-wp-pot' ),
    runSequence = require( 'run-sequence' ),
    
    sass        = require( 'gulp-sass' ),
    sourcemaps  = require( 'gulp-sourcemaps' ),
    globbing    = require( 'gulp-css-globbing' ),
    
    concat      = require( 'gulp-concat' ),
    uglify      = require( 'gulp-uglify' );


/*SASS: `compressed` `expanded` `compact` `nested` */
gulp.task( 'sass', () =>
    gulp.src( theme + '/sass/style.scss' )
        .pipe( globbing({
            extensions: ['.scss']
        }))
        .pipe( sourcemaps.init())
        .pipe( sass( { outputStyle: 'expanded' } ).on( 'error', sass.logError ) )
        .pipe( sourcemaps.write( '.' ) )
        .pipe( gulp.dest( theme ) )
);

/*SCRIPTS*/
function handleError ( e ) {
    console.log( e.toString() );
    this.emit( 'end' );
}

/*BROSWER SYNC*/
// BrowserSync
function browserSync(done) {
    browsersync.init({
        proxy: 'http://' + theme + '.io'
    });
    done();
}

// BrowserSync Reload
function browserSyncReload(done) {
  browsersync.reload();
  done();
}

/*CREATE .POT FILE*/
gulp.task( 'pot', () => {
    gulp.src( theme + '/**/*.php' )
        .pipe( wpPot( {
            domain: theme,
            package: 'Haintheme'
        } ) )
        .on( 'error', handleError )
        .pipe( gulp.dest( theme + '/languages/' + theme + '.pot' ) );
} );

function clean() {
  return del( null );
}

function css() {
  return gulp
    .src(theme + "/sass/style.scss")
    .pipe(sass({ outputStyle: "expanded" }))
    .pipe(gulp.dest( theme ))
    .pipe(browsersync.stream());
}

gulp.task("css", css);

function watchFiles() {
  gulp.watch(theme + "/sass/**/*", css);
}

gulp.task("clean", clean);



// build
gulp.task(
  'build',
  gulp.series(clean, gulp.parallel(css))
);

// watch
gulp.task("watch", gulp.parallel(watchFiles, browserSync));

gulp.task( 'default', gulp.parallel( 'watch' ) );