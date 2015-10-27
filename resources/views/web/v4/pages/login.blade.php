@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					Login
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-6 col-lg-4 col-md-offset-8 mt-xxl">
				<h1>Welcome Back, CAPCUSERS!</h1>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-6 col-lg-4 col-lg-offset-8 bg-white pt-xl pb-xl border-1 border-solid border-black">
				<a href="{{ route('web.login', ['provider' => 'facebook']) }}" class='btn btn-block text-white btn-facebook'><i class='fa fa-facebook mr-5'></i> Login dengan Facebook</a>
					<div class='text-center text-muted mt-md mb-md'>
						<div class="row">
							<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5"><hr></div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pt-xs">atau</div>
							<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5"><hr></div>
						</div>
					</div>
				<a href="{{ route('web.login', ['provider' => 'twitter']) }}" class='btn btn-block text-white btn-twitter'><i class='fa fa-twitter mr-5'></i> Login dengan Twitter</a>
			</div>
		</div>
	</div>
@stop

@section('body_class')
	bg-seamless
@stop


@section('search_tour_tab')
@stop

@section('ads_leaderboard')
@overwrite


@section('content_2')
	
@stop