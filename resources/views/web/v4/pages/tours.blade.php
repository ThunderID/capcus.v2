@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<!-- BREADCRUMB -->
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					@if ($tag)
						<a href="{{ route('web.tour') }}">Paket Tour</a>
						<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
						<span>{{$tag->tag}}</span>
					@else
						<span>Paket Tour</span>
					@endif
					<!-- /BREADCRUMB -->
				</div>
			</div>
		</div>
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
	<div class='container'>
		<div class="row mt-lg mb-xl">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class='pull-right'>@include('web.v3.components.tour_schedules.display_options')</div>
				<h1 class='text-lg text-uppercase'>
					@if ($tag)
						PAKET TOUR <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>#{{$tag->tag}}</span>
					@else
						Paket Tour 
						@if ($filters['travel_agent'])
							oleh <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{$filters['travel_agent']->name}}</span>
						@endif
						@if ($filters['tujuan'])
							ke <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{$filters['tujuan']->name}}</span>
						@endif
						@if ($filters['keberangkatan']['from'] && $filters['keberangkatan']['to'])
							keberangkatan <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{ $filters['keberangkatan']['from']->format('d M Y')}} - {{ $filters['keberangkatan']['to']->format('d M Y')}}</span>
						@endif

						@if ((!is_null($filters['budget']['min']) && !is_null($filters['budget']['max'])) && ((($filters['budget']['min'] != 0) && ($filters['budget']['max'] != 999999999)) || ($filters['budget']['min'] == 0 && $filters['budget']['max'] != 999999999) || ($filters['budget']['min'] != 0 && $filters['budget']['max'] == 999999999)))
							@if ($filters['budget']['max'] == 999999999) 
								dengan harga mulai <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>IDR {{number_format($filters['budget']['min'],0,',','.')}} </span>
							@else 
								dengan harga <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>IDR {{number_format($filters['budget']['min'],0,',','.')}} - IDR {{number_format($filters['budget']['max'],0,',','.')}}</span>
							@endif
						@endif

						@if ($filters['place'])
							(Mengunjungi {{$filters['place']->long_name}})
						@endif
					@endif
				</h1>

				<p class='text-muted text-md text-light'>
					@if ($tour_schedules_count > $max_data)
						Ditemukan Lebih dari {{$max_data}} paket tour, Silahkan melakukan pencarian lebih spesifik untuk mempermudah perbandingan
					@else
						Ditemukan {{$tour_schedules_count}} paket tour
					@endif
				</p>
			</div>
		</div>

		<div class="row">
			@if ($filter_schedules['price']['max'])
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					@include('web.v4.components.tour_schedules.filter_results', ['filter_schedules' => $filter_schedules])
				</div>
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<main>
						@include('web.v4.components.tour_schedules.table')
					</main>
				</div>
			@else
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<main>
						@include('web.v4.components.tour_schedules.table')
					</main>
				</div>
			@endif
		</div>
	</div>
@stop