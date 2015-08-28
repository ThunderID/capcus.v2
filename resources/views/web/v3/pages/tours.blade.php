@section('content_1')
	<!-- HEADING PAGE -->
	<section class="awe-parallax bg-tour-page">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="category-heading-content category-heading-content__2">
				<!-- BREADCRUMB -->
				<div class="breadcrumb">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						<li><span>Paket Tour</span></li>
					</ul>
				</div>
				<!-- /BREADCRUMB -->

				<div class="bg-white-glass pt-lg pb-xxxl pl-lg pr-xl">
					<h2 class="text-center text-black mb-lg text-uppercase">Temukan Paket Tour untuk Anda</h2>
					<div class='search_tour'>
						<div class='ui-tabs-panel text-black'>
							@include('web.v3.components.search.tour_form', [
								'travel_agent_list'				=> $all_travel_agents,
								'destination_list'				=> $all_destinations,
								'departure_list'				=> $departure_list,
								'budget_list'					=> $budget_list,
								'default_filter_travel_agent'	=> ($travel_agent ? $travel_agent->slug : null),
								'default_filter_tujuan'			=> ($tujuan ? $tujuan->path_slug : null),
								'default_filter_keberangkatan'	=> ($keberangkatan ? $keberangkatan : null),
								'default_filter_budget'			=> ($budget ? $budget['min'] . '-' . $budget['max']: null),
								'default_start_date_ymd'		=> ($departure_from ? $departure_from->format('Ymd') : \Carbon\Carbon::now()->format('Ymd')),
								'default_end_date_ymd'			=> ($departure_to ? $departure_to->format('Ymd') : \Carbon\Carbon::now()->addMonth(3)->format('Ymd')),
							])
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END / HEADING PAGE -->
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container">
		<div class="row mt-lg mb-xl">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class='pull-right'>@include('web.v3.components.tour_schedules.display_options')</div>
				<h4 class='text-md text-uppercase'>
					@if ($tag)
						PAKET TOUR <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>#{{$tag->tag}}</span>
					@else
						Paket Tour 
						@if ($travel_agent)
							oleh <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{$travel_agent->name}}</span>
						@endif
						@if ($tujuan)
							ke <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{$tujuan->name}}</span>
						@endif
						@if ($departure_from && $departure_to)
							keberangkatan <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{ $departure_from->format('d M Y')}} - {{ $departure_to->format('d M Y')}}</span>
						@endif

						@if ((!is_null($budget['min']) && !is_null($budget['max'])) && ((($budget['min'] != 0) && ($budget['max'] != 999999999)) || ($budget['min'] == 0 && $budget['max'] != 999999999) || ($budget['min'] != 0 && $budget['max'] == 999999999)))
							@if ($budget['max'] == 999999999) 
								dengan harga mulai <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>IDR {{number_format($budget['min'],0,',','.')}} </span>
							@else 
								dengan harga <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>IDR {{number_format($budget['min'],0,',','.')}} - IDR {{number_format($budget['max'],0,',','.')}}</span>
							@endif
						@endif
					@endif
				</h4>

				<h5 class='text-muted text-md text-light'>
					@if ($tour_schedules_count > $max_data)
						Ditemukan Lebih dari {{$max_data}} paket tour, Silahkan melakukan pencarian lebih spesifik untuk mempermudah perbandingan
					@else
						Ditemukan {{$tour_schedules_count}} paket tour
					@endif
				</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				@include('web.v3.components.tour_schedules.filter_results', ['filter_schedules' => $filter_schedules])
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
				@include('web.v3.components.tour_schedules.table')
			</div>
		</div>
	</div>
@stop