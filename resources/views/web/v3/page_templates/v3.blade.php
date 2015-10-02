<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- TITLE -->
	<title>{{$title}}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<!-- GOOGLE FONT -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:700,600,400,300|Lato:400,700' rel='stylesheet' type='text/css'>

	<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">

	<!-- CSS LIBRARY -->
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/web_v3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/web_v3_style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/colors/yellow.css')}}">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	@forelse ($og as $x)
		<meta property="{{ $x }}" content="{{$og[$x]}}">
	@empty
	@endforelse

	@yield('css')

	{{-- ADS --}}
	<script type='text/javascript'>
	  var googletag = googletag || {};
	  googletag.cmd = googletag.cmd || [];
	  (function() {
	    var gads = document.createElement('script');
	    gads.async = true;
	    gads.type = 'text/javascript';
	    var useSSL = 'https:' == document.location.protocol;
	    gads.src = (useSSL ? 'https:' : 'http:') +
	      '//www.googletagservices.com/tag/js/gpt.js';
	    var node = document.getElementsByTagName('script')[0];
	    node.parentNode.insertBefore(gads, node);
	  })();
	</script>

	<script type='text/javascript'>
	  googletag.cmd.push(function() {
	    googletag.defineSlot('/176127224/CAPCUS-300x250', [300, 250], 'div-gpt-ad-1443787522312-0').addService(googletag.pubads());
	    googletag.defineSlot('/176127224/CAPCUS-728x90', [728, 90], 'div-gpt-ad-1443787522312-1').addService(googletag.pubads());
	    googletag.pubads().enableSingleRequest();
	    googletag.pubads().collapseEmptyDivs();
	    googletag.enableServices();
	  });
	</script>

</head>

<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->


	<!-- PAGE WRAP -->
	<div id="page-wrap">
		
		<!-- PRELOADER -->
		{{-- <div class="preloader"></div> --}}
		<!-- END / PRELOADER -->

		<!-- HEADER PAGE -->
		<header id="header-page">
			<div class="header-page__inner">
				<div class="container">
					<!-- LOGO -->
					<div class="logo">
						<a href="{{ route('web.home') }}">
							{!! Html::image('images/logo-black-small.png', $web_title) !!}
						</a>
					</div>
					<!-- END / LOGO -->
					
					<!-- NAVIGATION -->
					@yield('nav', '[nav]')
					<!-- END / NAVIGATION -->
					
					{{-- SEARCH BOX --}}
					@yield('search', '[search]')
					{{-- END / SEARCH BOX --}}

					<!-- TOGGLE MENU RESPONSIVE -->
					@yield('toggle-menu-responsive', '[toggle-menu-responsive]')
					<!-- END / TOGGLE MENU RESPONSIVE -->
				</div>
			</div>
		</header>
		<!-- END / HEADER PAGE -->
		
		{{-- carousel --}}
		@yield('content_1', '[content_1]')

		<!-- SEARCH TABS -->
		@yield('search_tour_tab', '[search_tour_tab]')
		<!-- END / SEARCH TABS -->

		@yield('ads_leaderboard', '[ads_leaderboard]')



		@yield('content_2', '[content_2]')

		@yield('footer_top_margin')

		<!-- FOOTER PAGE -->
		<footer id="footer-page">
			<div class="container">
				@yield('footer', '[footer]')
			</div>
		</footer>
		<!-- END / FOOTER PAGE -->
	</div>
	<!-- END / PAGE WRAP -->

	<!-- LOAD JQUERY -->
	<script>
		var web_url = '{{Config::get('app.url')}}';
	</script>
	<script type="text/javascript" src="{{ asset('js/web_v3.js') }}"></script>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55dca75101742d57" async="async"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55dca75101742d57" async="async"></script>

	


	@yield('basic_js')
	@yield('js')
</body>
</html>