<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{$html_title or 'CAPCUS.id'}}</title>

		<!-- Bootstrap CSS -->
		<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700|Happy+Monkey' rel='stylesheet' type='text/css'>
		<link href="{{elixir('css/web.css')}}" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->


		@yield('css')
	</head>
	<body>
		<nav>
			@yield('nav', '[nav]')
		</nav>
		
		<div class="clearfix">
			@yield('content_1', '[content_1]')
			<div class="container">
				<div class="row mt-md">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						@include('web.v2.components.ads.leaderboard')
					</div>
				</div>

				{{-- CONTENT --}}
				@yield('content_2', '[content_2]')
			</div>
		</div>

		{{-- FOOTER --}}
		<footer>
			<div class="container pt-lg pb-lg mt-lg mb-0">
				@yield('footer', '[footer]')
			</div>
		</footer>


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		@yield('js')
	</body>
</html>