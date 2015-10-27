@section('content_1')
	{{-- @include('web.v4.components.common.carousel', ['carousel_items' => $headlines]) --}}
	<div class='hidden-xs hidden-sm border-0 border-top-1 border-bottom-1 border-solid border-black'>
		@include('web.v4.components.common.bscarousel', ['carousel_items' => $headlines])
	</div>
	<div class='hidden-md hidden-lg'>
		@include('web.v4.components.common.mobile_carousel', ['carousel_items' => $headlines])
	</div>
@stop

@section('search_tour_tab')
	@include('web.v4.components.common.search_tour_tab', [
		'travel_agent_list'				=> $all_travel_agents,
		'destination_list'				=> $all_destinations,
		'departure_list'				=> $departure_list,
		'budget_list'					=> $budget_list,
		'default_filter_travel_agent'	=> null,
		'default_filter_tujuan'			=> null,
		'default_filter_keberangkatan'	=> null,
		'default_filter_budget'			=> null,
		'default_start_date_ymd'		=> \Carbon\Carbon::now()->format('Ymd'),
		'default_end_date_ymd'			=> \Carbon\Carbon::now()->addMonth(3)->endOfMonth()->format('Ymd'),
	])
@stop

@section('content_2')
	<section>
		<div class='container mt-xs mb-sm'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					<h3 class='text-light text-uppercase mb-lg'>Terdapat <a href="{{ route('web.tour') }}" class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{ number_format($total_upcoming_tours) }} Paket Tour</a> untuk berbagai tujuan</h3>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container" class="mb-md">
			@include('web.v4.components.home.homegrids',[])
		</div>
	</section>

	<section>
		<div class="container mt-lg">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					{{-- PAKET TOUR TERBARU WITH MASONRY STYLE--}}
					<h3 class='text-uppercase'>Paket Tour Terbaru</h3>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							@for ($i = 0; $i < ceil($latest_tours->count() / 2); $i++)
								@include('web.v4.components.tours.tour_thumbnail', ['tour' => $latest_tours[$i]])
							@endfor		
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							@for ($i = ceil($latest_tours->count() / 2); $i < $latest_tours->count(); $i++)
								@include('web.v4.components.tours.tour_thumbnail', ['tour' => $latest_tours[$i]])
							@endfor		
						</div>
					</div>

					<div class="clearfix"></div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
					<div class="well bg-yellow">
						@include('web.v4.components.home.sidebar',[])
					</div>

					<div class="clearfix mt-xl"></div>
					<h4 class=''>DESTINASI TERPOPULER</h4>
					@include('web.v4.components.destinations.sidebar',['destinations' => $top_destinations])

				</div>
			</div>
		</div>
	</section>
@stop