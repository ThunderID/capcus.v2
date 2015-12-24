@section('nav')
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
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Paket Tour <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('web.tour')}}">Semua</a></li>
							<li role="separator" class="divider"></li>
							
							@forelse ($tour_shortcut['destinations'] as $label => $link)
								<li><a href="{{$link}}">{{$label}}</a></li>
							@empty
							@endforelse
							
							<li role="separator" class="divider"></li>
							@forelse ($tour_shortcut['tags'] as $label => $link)
								<li><a href="{{$link}}">{{$label}}</a></li>
							@empty
							@endforelse
						</ul>
					</li>
					{{-- <li><a href="{{ route('web.place')}}">Tujuan Wisata</a></li> --}}
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
@stop

@section('ads_leaderboard')
	@include('web.v4.components.ads.728x90')
@stop

@section('footer')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@include('web.v4.components.common.footer')
			</div>
		</div>
	</div>
@stop

@section('header_js')
	@include('web.v4.components.js.google_dfp')
@stop

@section('basic_js')
	@include('web.v4.components.js.compare_tour')
	@include('web.v4.components.js.carousel_clickable')
	@include('web.v4.components.js.google_analytics')
	@include('web.v4.components.js.addthis')
	<script src="{{ asset('plugins/bootstrap-datepicker.min.js')}}"></script>
	<script>
		// DATERANGE
		$('.input-daterange').datepicker({
			format: "dd-mm-yyyy",
			forceParse: false,
			todayHighlight: true
		});
	</script>

	@if (\Carbon\Carbon::now()->lte(\Carbon\Carbon::parse('2016-02-01')))
		<script src="{{ asset('plugins/jquery.snow.min.1.0.js')}}"></script>
		<script>
			$(document).ready( function(){
				$.fn.snow({ minSize: 5, maxSize: 50, newOn: 300, flakeColor: '#f5f5ff' });
			});
		</script>
	@endif

@stop
