@section('content_1')
	<!-- HEADING PAGE -->
	<section class="awe-parallax bg-capcus" style="background:transparent url({{asset('images/bg.jpg')}} bottom left repeat-x)">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="category-heading-content category-heading-content__2 text-uppercase">
				<!-- BREADCRUMB -->
				<div class="breadcrumb">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						<li><span>Paket Tour</span></li>
					</ul>
				</div>
				<!-- /BREADCRUMB -->

				<div class="bg-white-glass pt-lg pb-xxxl pl-lg pr-xl">
					<h2 class="text-center text-black">Temukan Paket Tour untuk Anda</h2>
					<div class='search_tour'>
						<div class='ui-tabs-panel text-black'>
							@include('web.v3.components.search.tour_form', [
								'travel_agent_list'				=> $all_travel_agents,
								'destination_list'				=> $all_destinations,
								'departure_list'				=> $departure_list,
								'budget_list'					=> $budget_list,
								'default_filter_travel_agent'	=> $travel_agent->slug,
								'default_filter_tujuan'			=> $tujuan->path_slug,
								'default_filter_keberangkatan'	=> $keberangkatan,
								'default_filter_budget'			=> $budget,
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
					Paket Tour 
					@if ($travel_agent)
						oleh <span class='text-primary'>{{$travel_agent->name}}</span>
					@endif
					@if ($tujuan)
						ke <span class='text-primary'>{{$tujuan->name}}</span>
					@endif
					@if ($keberangkatan['year'])
						keberangkatan <span class='text-primary'>{{get_bulan($keberangkatan['month']*1) . ' ' . $keberangkatan['year']}}</span>
					@endif
					@if ((!is_null($budget['min']) && !is_null($budget['max'])) && ((($budget['min'] != 0) && ($budget['max'] != 999999999)) || ($budget['min'] == 0 && $budget['max'] != 999999999) || ($budget['min'] != 0 && $budget['max'] == 999999999)))
						@if ($budget['max'] == 999999999) 
							dengan harga mulai <span class='text-primary'>IDR {{number_format($budget['min'],0,',','.')}} </span>
						@else 
							dengan harga <span class='text-primary'>IDR {{number_format($budget['min'],0,',','.')}} - IDR {{number_format($budget['max'],0,',','.')}}</span>
						@endif
					@endif
				</h4>
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