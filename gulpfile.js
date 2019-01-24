'use strict';

let autoprefixer = require( 'gulp-autoprefixer' );
let del = require( 'del' );
let gulp = require( 'gulp' );
let runSequence = require( 'run-sequence' );
let sass = require( 'gulp-sass' );
let cleanCSS = require( 'gulp-clean-css' );

const AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4.4',
	'bb >= 10'
];

gulp.task( 'styles', function() {
	return gulp.src( [
		'./src/Resources/scss/styles.scss',
		'./node_modules/bootstrap/dist/css/bootstrap.css'
	] )
		.pipe( sass( {
			outputStyle: 'nested',
			precision: 10,
			includePaths: [ '.' ],
			onError: console.error.bind( console, 'Sass error:' )
		} ) )
		.pipe( autoprefixer( { browsers: AUTOPREFIXER_BROWSERS } ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( gulp.dest( './example/dist/css' ) )
} );

gulp.task( 'external-scripts', function() {
	return gulp.src( [
		'./node_modules/bootstrap/dist/js/bootstrap.min.js',
		'./node_modules/jquery/dist/jquery.min.js',
	] )
		.pipe( gulp.dest( './example/dist/js' ) )
} );

gulp.task( 'clean', () => del( [ 'example/dist' ] ) );
gulp.task( 'default', [ 'clean' ], function() {
	runSequence(
		'styles',
		'external-scripts',
	);
} );
