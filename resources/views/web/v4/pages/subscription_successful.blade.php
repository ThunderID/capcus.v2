@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					Subscribe
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-push-3 text-black">
				<h3 class='mb-lg mt-xxxl text-uppercase'>Welcome!</h3>

				<div class="panel panel-default">
					<div class="panel-body pt-lg pb-lg">
						<div class='ml-sm mr-sm'>
							<p class='text-lg'>Selamat, {{$subscriber->email}}!</p>

							<p>Email anda telah kami tambahkan ke dalam daftar pelanggan newsletter kami. Kami akan kirimkan penawaran-penawaran terbaik ke dalam email anda</p>

							<p class='mt-md mb-md'>Untuk dapat menggunakan fasilitas lebih dari kami, silahkan login di di bawah ini</p>
							<p class='text-center'><a href="{{ route('web.login')}}" class='btn btn-yellow'>LOGIN</a>
						</p>
					</div>
				</div>
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