<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- TITLE -->
	<title>CAPCUS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<!-- GOOGLE FONT -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300|Oswald:400|Lato:400,700' rel='stylesheet' type='text/css'>

	<!-- CSS LIBRARY -->
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/web_v3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/web_v3_style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/colors/yellow.css')}}">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
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
					
					<!-- SEARCH BOX -->
					@yield('search', '[search]')
					<!-- END / SEARCH BOX -->

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

		@yield('content_2', '[content_2]')

		<div class="clearfix mt-xxxl"></div>
		
		<!-- FOOTER PAGE -->
		<footer id="footer-page" class='mt-xxxl'>
			<div class="container">
				@yield('footer', '[footer]')
			</div>
		</footer>
		<!-- END / FOOTER PAGE -->
	</div>
	<!-- END / PAGE WRAP -->


	<!-- LOAD JQUERY -->
	<script type="text/javascript" src="{{ asset('js/web_v3.js') }}"></script>

	@yield('basic_js')
	@yield('js')
</body>
</html>