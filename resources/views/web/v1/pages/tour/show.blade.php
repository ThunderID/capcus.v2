@section('content_body')
	<div class="container-fluid">
		<div class="row">

			{{-- LEADERBOARD BEFORE CONTENT & SIDEBAR --}}
			<div class="hidden-xs hidden-sm col-md-12 hidden-lg mt-md">
				@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			{{-- MAIN CONTENT --}}
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				{{-- LEADERBOARD --}}
				<div class='text-center hidden-md mt-md'>
					@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
				</div>

				{{-- TITLE --}}
				<h1 class='text-uppercase mb-lg'>
					{{$tour->name}}
				</h1>

				{{-- CONTENT --}}
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
						<div class="panel panel-default ">
							<div class="panel-heading pr-0 pb-0 pt-0 pl-0 overflowhidden">
								<div class='relative'>
									{!! Html::image($tour->thumbnail_lg, $tour->name, ['class' => 'fullwidth tour_thumbnail', 'data-src' => $tour->thumbnail_lg]) !!}
								</div>
							</div>
							<div class="panel-body relative">
								{!! $tour->content !!}
							</div>
						</div>

						<div class="well well-sm pb-xs">
							<div class='title'>DETAIL PERJALANAN</div>
							{!! $tour->rundown !!}
						</div>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">

						{{-- VENDOR SUMMARY --}}
						<div class="well well-sm text-center pb-md">
							<a href='{{route("web.tour", ["vendor" => $tour->vendor->slug])}}' title='Klik untuk melihat semua tour dari {{$tour->vendor->name}}'>
								{!! Html::image($tour->vendor->logo_sm, $tour->vendor->name, ['class' => '', 'style' => "height:100px"]) !!}
							</a>
							<br><strong class='text-uppercase'>{{$tour->vendor->name}}</strong>
							<br>{{$tour->vendor->address}}
							<br>{{$tour->vendor->phone}}
							<br><a href='{{$tour->vendor->website}}' target="_blank">{{$tour->vendor->website}}</a>
						</div>

						{{-- KEBERANGKATAN --}}
						<div class="well well-sm text-center">
							<div class='title'>Jadwal</div>

							<div class="row">
								<?php $i = 0; ?>
								@foreach ($tour->schedules as $x)
									@if ($i)
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-xs mb-md">
											<hr class='border-dotted border-light'>
										</div>
									@endif 

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="row">
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<strong>Berangkat</strong>
												<br/>{{$x->depart_at->day}} {{get_bulan($x->depart_at->month)}} {{$x->depart_at->year}}
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<strong>Kembali</strong>
												<br/>{{$x->return_at->day}} {{get_bulan($x->return_at->month)}} {{$x->return_at->year}}
											</div>
										</div>
										<p class='mt-sm text-primary text-md'>{{$x->currency}} {{number_format($x->price)}}</p>
										<p class='mt-sm'><a href='{{route("web.voucher.create", ["vendor" => $tour->vendor->slug, "tour" => $tour->slug, "schedule" => $x->id])}}' class='btn btn-primary'>Voucher {{$x->currency}} {{number_format($x->discount)}}</a></p>
									</div>

									<?php $i++; ?>
								@endforeach
							</div>
						</div>

						{{-- PAKET --}}
						<div class="well well-sm">
							<div class='title'>PAKET TERMASUK</div>
							@foreach (explode("\n", $tour->package_including) as $x)
								<div class="row mb-5">
									<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
										<span class='text-primary'><i class='fa fa-check'></i></span>
									</div>
									<div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
										{{$x}}
									</div>
								</div>
							@endforeach
						</div>

						<div class="well well-sm">
							<div class='title'>PAKET TIDAK TERMASUK</div>
							@foreach (explode("\n", $tour->package_excluding) as $x)
								<div class="row mb-5">
									<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
										<span class='text-danger'><i class='fa fa-close'></i></span>
									</div>
									<div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
										{{$x}}
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3 class='text-uppercase'>PAKET TOUR KE {{$tour->categories[0]->name}} LAINNYA</h3>

						@include('web.v1.widgets.tours.grid', [ 
							'tours' => $other_tours
						])
					</div>
				</div>

			</div>

			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-md">
				@include('web.v1.widget_group.sidebar.basic')
			</div>

		</div>
	</div>

	@section('js')
		@parent
		{!! Html::script('plugins/owl.carousel-2/owl-carousel/owl.carousel.min.js') !!}

		<script>
			$('.owl-carousel').owlCarousel({
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				stopOnHover: true,
				scrollPerPage: true,
				pagination:false,

				items : 2,
				itemsDesktop: [1200,2],
				itemsDesktopSmall: [992,2],
				itemsTablet: [768,1]
			});

			$('.carousel > .btn-prev').click(function() {
				$(this).parent().find('.owl-carousel').trigger('owl.prev');
			});

			$('.carousel > .btn-next').click(function() {
				$(this).parent().find('.owl-carousel').trigger('owl.next');
			});

		</script>
	@stop

	@section('css')
		@parent
		{!! Html::style('plugins/owl.carousel-2/owl-carousel/owl.carousel.css') !!}
		{!! Html::style('plugins/owl.carousel-2/owl-carousel/owl.theme.css') !!}
	@stop
@stop