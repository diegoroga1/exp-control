const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue().extract(['vue', 'bootstrap'])

mix.sass('resources/sass/app.scss', 'public/css')
mix.combine(
    [
        'resources/theme/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/theme/vendor/jquery-easing/jquery.easing.js',
        'resources/theme/js/theme.js',
    ],
    'public/js/theme.js'
)
if (mix.inProduction()) {
	mix.combine(
		[
			'resources/theme/vendor/bootstrap/js/bootstrap.bundle.min.js',
			'resources/theme/vendor/jquery-easing/jquery.easing.js',
			'resources/theme/js/theme.js',
		],
		'public/js/theme.js'
	)

	mix.postCss('resources/css/jetstream.css', 'public/css', [
		require('postcss-import'),
		require('tailwindcss'),
	])

	mix.sass('resources/theme/scss/theme.scss', 'public/css')

	mix.sourceMaps()
	mix.version()
}
