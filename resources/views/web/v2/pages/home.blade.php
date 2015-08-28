@section('content_1')
	@include('web.v2.components.common.carousel', ['carousel_items' => $headlines])
@stop

@section('content_2')
	<div class="row mt-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			@include('web.v2.components.common.search_tour_form',[
				'travel_agent_list'				=> $all_travel_agents,
				'destination_list'				=> $all_destinations,
				'departure_list'				=> $departure_list,
				'budget_list'					=> $budget_list,
				'default_filter_travel_agent'	=> null,
				'default_filter_tujuan'			=> null,
				'default_filter_keberangkatan'	=> null,
				'default_filter_budget'			=> null,
			])
		</div>
	</div>

	<div class="row mt-md homegrid">
		@include('web.v2.components.home.destination_grid')
	</div>
@stop