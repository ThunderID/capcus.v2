@section('content_1')
	<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="login-register-page__content">
				<div class="content-title">
					<span>Welcome back</span>
					<h2>EXPLORER!</h2>
				</div>
				<form>
					<a href="{{ route('web.login', ['provider' => 'facebook']) }}" class='btn btn-block text-white btn-facebook'><i class='fa fa-facebook mr-5'></i> Login dengan Facebook</a>
					<div class='text-center text-muted mt-md mb-md'>
						<div class="row">
							<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5"><hr></div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pt-xs">atau</div>
							<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5"><hr></div>
						</div>
					</div>
					<a href="{{ route('web.login', ['provider' => 'twitter']) }}" class='btn btn-block text-white btn-twitter'><i class='fa fa-twitter mr-5'></i> Login dengan Twitter</a>
				</form>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	
	
@stop