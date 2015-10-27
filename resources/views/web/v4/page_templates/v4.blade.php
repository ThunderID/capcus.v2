<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">

		<title>{{ $title }}</title>

		<!-- GOOGLE FONT -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:700,600,400,300|Lato:400,700' rel='stylesheet' type='text/css'>
		<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
		<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css')}}">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		@forelse ($og as $k => $x)
			<meta property="og:{{ $k }}" content="{{$x}}">
		@empty
		@endforelse

		@yield('css')
		@yield('header_js')
	</head>
	<body class="@yield('body_class')">
		{{-- HEADER --}}
		<head>
			@yield('nav', '[nav]')
		</head>

		{{-- BODY --}}
		<main>
			@yield('content_1')
			
			<div class="mt-xxl">
				@yield('search_tour_tab', '[search_tour_tab]')
			</div>
			
			<div class="mt-xxl">
				@yield('ads_leaderboard')
			</div>
			@yield('content_2')
			@yield('content_3')
		</main>

		{{-- FOOTER --}}
		<div class='mt-xxl pt-xxl'></div>
		<footer>
			<div class='footer pt-xxl pb-xxl'>
				@yield('footer')

				<div class="clearfix  mb-xxl"></div>
			</div>
		</footer>

		{{-- CSS --}}
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		{{-- JAVASCRIPT --}}
		<script>
			var web_url = '{{Config::get('app.url')}}';
		</script>
		{!! Html::script(elixir('js/web_v4.js')) !!}
		{!! Html::style(elixir('css/select2.css')) !!}
		{!! Html::script("//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js") !!}
		@yield('basic_js')
		@yield('js')

	</body>
</html>