/**
 * Load More Stuff plugin gulp scripts.
 */

// Declare gulp libraries.
const gulp       = require( 'gulp' ),
      browserify = require( 'browserify' ),
      buffer     = require( 'vinyl-buffer' ),
      source     = require( 'vinyl-source-stream' ),
      uglify     = require( 'gulp-uglify' );

// Array of JS files, in order by dependency.
const jsFiles = [
  'load-more/source/js/load-more-button.js'
];

// Task function to build the JS files.
function buildJs() {
  return browserify( { entries: jsFiles } )
    .transform( 'babelify', { presets: [ "@babel/preset-env", "@babel/preset-react" ] } )
    .bundle()
    .pipe( source( 'load-more-stuff.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'load-more/build' ) );
}

// Task definitions.
gulp.task( 'default', buildJs );
