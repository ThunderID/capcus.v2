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
    	.less('web/default/style1.less')
    	// .less('web/default2/style2.less')
    	.version(['public/css/admin.css',
    				'public/css/style1.css',
    				// 'public/css/style2.css',
    			])
    	.copy('public/fonts', 'public/fonts/')
    	.copy('resources/assets/plugins/', 'public/plugins/')
    	.copy('resources/assets/images/', 'public/images/');
});
