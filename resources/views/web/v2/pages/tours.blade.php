@section('content_1')
	<div class='text-center pt-lg pb-lg bg-dark-glass text-uppercase text-lg text-bold'>
		@if ($tujuan)
			{{$tujuan->path_slug}}
		@else
			SEMUA TUJUAN
		@endif
	</div>
@stop

@section('content_2')

	<div class="row mt-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			@include('web.v2.components.common.search_tour_form',[
				'travel_agent_list'		=> $all_travel_agents,
				'destination_list'		=> $all_destinations,
				'departure_list'		=> $departure_list,
				'budget_list'			=> $budget_list,
				'default_filter_travel_agent'	=> $travel_agent->slug,
				'default_filter_tujuan'			=> $tujuan->path_slug,
				'default_filter_keberangkatan'	=> $keberangkatan['year'].$keberangkatan['month'],
				'default_filter_budget'			=> $budget['min'].'-'.$budget['max']
			])
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class='mt-lg text-uppercase text-lg'>
				Paket Tour 
				@if ($travel_agent)
					oleh <span class='text-primary'>{{$travel_agent->name}}</span>
				@endif
				@if ($tujuan)
					ke <span class='text-primary'>{{$tujuan->name}}</span>
				@endif
				@if ($departure_from && $departure_to)
					keberangkatan <span class='text-primary'>{{ $departure_from->format('d M Y')}} - {{ $departure_to->format('d M Y')}}</span>
				@endif
				@if ((!is_null($budget['min']) && !is_null($budget['max'])) && ((($budget['min'] != 0) && ($budget['max'] != 999999999)) || ($budget['min'] == 0 && $budget['max'] != 999999999) || ($budget['min'] != 0 && $budget['max'] == 999999999)))
					@if ($budget['max'] == 999999999) 
						dengan harga mulai <span class='text-primary'>IDR {{number_format($budget['min'],0,',','.')}} </span>
					@else 
						dengan harga <span class='text-primary'>IDR {{number_format($budget['min'],0,',','.')}} - IDR {{number_format($budget['max'],0,',','.')}}</span>
					@endif
				@endif
			</h1>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-md">
			@include('web.v2.components.tours.data_table',[
				'tour_schedules'		=> $tour_schedules,
				'travel_agent_list'		=> $all_travel_agents,
				'destination_list'		=> $all_destinations,
				'departure_list'		=> $departure_list,
				'budget_list'			=> $budget_list,
			])
		</div>
	</div>

@stop