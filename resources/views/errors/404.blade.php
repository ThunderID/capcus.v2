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
	<body class="bg-seamless">
		{{-- HEADER --}}
		<head>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ route('web.home')}}">
							{!! Html::image('images/logo-black-small.png', 'Capcus.id - Paket tour Indonesia', ['style' => 'margin-top:-11px']) !!}
						</a>
					</div>
				
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{ route('web.home')}}">Home</a></li>
							<li><a href="{{ route('web.tour')}}">Paket Tour</a></li>
							<li><a href="{{ route('web.blog')}}">Blog</a></li>
							@if (Auth::user()->id)
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, {{Auth::user()->name}} <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="{{ route('web.logout')}}">Logout</a></li>
									</ul>
								</li>
							@else
								<li><a href="{{ route('web.login')}}">Sign In/Sign Up</a></li>
							@endif
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</head>

		{{-- BODY --}}
		<main>
			<div class="clearfix mt-xxxl pt-xxxl"></div>
			<div class="clearfix mt-xl pt-xl"></div>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mb-xxxl pb-xxxl">
						<h1 class='text-xxxl'>
							Whoopps!
							<br><small class='text-light'>Halaman yang anda cari tidak ditemukan. Silahkan klik tombol di bawah ini untuk kembali ke halaman depan</small>
						</h1>
						<p class='mt-xxl'><a href="{{ route('web.home')}}" class='btn btn-yellow'>
							<span class="glyphicon glyphicon-home mr-5" aria-hidden="true"></span> Buka CAPCUS.id
						</a>
					</div>
				</div>
			</div>
		</main>

		{{-- FOOTER --}}
		<div class='mt-xxl pt-xxl'></div>
		<footer>
			<div class='footer pt-xxl pb-xxl'>
				@include('web.v4.components.common.footer')

				<div class="clearfix  mb-xxl"></div>
			</div>
		</footer>

		{{-- CSS --}}
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		{{-- JAVASCRIPT --}}
		{!! Html::script(elixir('js/web_v4.js')) !!}
	</body>
</html>