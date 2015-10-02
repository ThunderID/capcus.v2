@section('content_1')
	@include('web.v3.components.common.bscarousel', ['carousel_items' => $headlines])
@stop

@section('search_tour_tab')
	<div class='search_tour'>
		@include('web.v3.components.common.search_tour_tab', [
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
	</div>
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
			@include('web.v3.components.home.homegrids',[])
		</div>
	</section>

	<section>
		<div class="container mt-lg">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					@include('web.v3.components.home.tour_tabs',[])
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
					@include('web.v3.components.home.sidebar',[])

					<h4 class='text-yellow'>Destinasi Trending</h4>
					@include('web.v3.components.destinations.sidebar',['destinations' => $top_destinations])

				</div>
			</div>
		</div>
	</section>

@stop