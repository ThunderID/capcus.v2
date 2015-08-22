var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('admin.less')
    	.less('web/v3/web.less')
    	.styles([
    			'web.v3/lib/bootstrap.min.css',
    			'web.v3/lib/font-awesome.min.css',
    			'web.v3/lib/jquery-ui.css',
    			'web.v3/lib/awe-booking-font.css',
    			'web.v3/lib/magnific-popup.css',
    			'web.v3/lib/owl.carousel.css',
    		], 'public/css/web_v3.css')
    	.sass('web/v3/web_v3_style.scss')
    	.scripts([
    			'web.v3/lib/jquery-1.11.2.min.js',
    			// 'web.v3/lib/masonry.pkgd.min.js',
				'web.v3/lib/jquery.parallax-1.1.3.js',
				'web.v3/lib/jquery.owl.carousel.js',
				'web.v3/lib/theia-sticky-sidebar.js',
				'web.v3/lib/jquery.magnific-popup.min.js',
				'web.v3/lib/jquery-ui.js',
				'web.v3/scripts.js'
    		], 'public/js/web_v3.js')
    	// .less('web/v2/web.less')
    	.version([
                    'public/css/admin.css',
                    'public/css/web_v3.css',
                    'public/css/web_v3_style.css',
                    'public/js/web_v3.js',
    			])
    	.copy('resources/assets/images/overlay-gallery.png', 'public/build/images')
    	.copy('resources/assets/css/web.v3/colors', 'public/css/colors')
    	.copy('resources/assets/css/web.v3/fonts', 'public/build/fonts/')
    	.copy('resources/assets/plugins/', 'public/plugins/')
    	.copy('resources/assets/images/', 'public/images/');
});
