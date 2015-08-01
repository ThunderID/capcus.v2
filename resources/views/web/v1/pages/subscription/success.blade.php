@section('content_body')
	<div class="container-fluid">
		<div class="row">

			{{-- LEADERBOARD BEFORE CONTENT & SIDEBAR --}}
			<div class="hidden-xs hidden-sm col-md-12 hidden-lg mt-xs">
				@include('web.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			{{-- MAIN CONTENT --}}
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<div class='text-center hidden-md mt-md'>
					@include('web.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
				</div>

				<div class='mb-md'>

					<h1 class='text-uppercase mb-lg'>
						Selamat Bergabung!
					</h1>

					<p>Selamat, anda telah terdaftar sebagai pelanggan newsletter Capcus melalui email {{$email}} dan anda akan mendapatkan informasi-informasi sehubungan dengan tour dari kami</p>
				</div>
			</div>

			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-md">
				<div class="row hidden-xs hidden-md hidden-lg">
					<div class="hidden-xs col-sm-6 hidden-md hidden-lg">
						@include('web.widgets.ads.250x250'		, ['widget_class' => 'mb-sm text-center'])
					</div>
					<div class="hidden-xs col-sm-6 hidden-md hidden-lg">
						@include('web.widgets.ads.250x250'		, ['widget_class' => 'mb-sm text-center'])
					</div>
				</div>

				<div class='hidden-sm'>
					<div class='mb'>
						@include('web.widgets.ads.250x250'			, ['widget_class' => 'mb-sm text-center'])
					</div>
				</div>

				@include('web.widgets.subscribe.form'			, ['widget_template' => 'well'])

				<div class='hidden-sm'>
					@include('web.widgets.ads.250x250'			, ['widget_class' => 'mb-sm text-center'])
				</div>

				@include('web.widgets.article.mini_list'		, [
					'widget_template' 	=> 'well',
					'widget_options'	=> [
												'data' => [
																'article_order'	=> 'latest_publish',
																'article_paginate' => 5,
																'article_current_page' => 1
															]
					]
				])

				@include('web.widgets.destination.mini_list'	, ['widget_template' => 'well'])
				@include('web.widgets.vendor.mini_list'		, [
					'widget_template' 	=> 'well',
					'widget_title'		=> 'Supported By',
					'widget_options'	=> [
												'data' => [
																'filter_vendor_category'	=> 8,
																'vendor_order' 				=> 'name',
																'vendor_paginate' 			=> 6,
																'vendor_current_page' 		=> 1
															]
					]
				])
			</div>

		</div>
	</div>
@stop