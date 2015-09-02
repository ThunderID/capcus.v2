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
						@if ($tag)
							<li><a href="{{ route('web.tour') }}">Paket Tour</a></li>
							<li><span>{{$tag->tag}}</span></li>
						@else
							<li><span>Paket Tour</span></li>
						@endif
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
								'default_filter_travel_agent'	=> $filters['travel_agent']->slug,
								'default_filter_tujuan'			=> $filters['tujuan']->path_slug,
								'default_filter_keberangkatan'	=> $filters['keberangkatan']['from'] . '-' . $filters['keberangkatan']['to'],
								'default_filter_budget'			=> $filters['budget']['min'] . ($filters['budget']['max'] ? '-' . $filters['budget']['max'] : ''),
								'default_start_date_ymd'		=> ($filters['keberangkatan']['from'] ? $filters['keberangkatan']['from']->format('Ymd') : \Carbon\Carbon::now()->format('Ymd')),
								'default_end_date_ymd'			=> ($filters['keberangkatan']['to'] ? $filters['keberangkatan']['to']->format('Ymd') : \Carbon\Carbon::now()->addMonth(3)->format('Ymd')),
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
				<h1 class='text-md text-uppercase'>
					@if ($tag)
						PAKET TOUR <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>#{{$tag->tag}}</span>
					@else
						Paket Tour 
						@if ($travel_agent)
							oleh <span class='border-top-0 border-left-0 border-right-0 border-bottom-2 border-dashed border-yellow text-yellow'>{{$filters['travel_agent']->name}}</span>
						@endif
						@if ($tujuan)
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
					@include('web.v3.components.tour_schedules.filter_results', ['filter_schedules' => $filter_schedules])
				</div>
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<main>
						@include('web.v3.components.tour_schedules.table')
					</main>
				</div>
			@else
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<main>
						@include('web.v3.components.tour_schedules.table')
					</main>
				</div>
			@endif
		</div>
	</div>
@stop