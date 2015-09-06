@section('content_1')
	<div class='text-center pt-xl pb-xl bg-dark-glass text-uppercase text-lg text-bold' style='background:#fff url({{ asset('images/bg.png')}}) center center'>
		{{$tour->destinations->first()->long_name}}
	</div>
@stop

@section('content_2')
	<div class="row mt-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			@include('web.v2.components.ads.leaderboard')
		</div>
	</div>

	<div class="row mt-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
{{-- 			@include('web.v2.components.common.search_tour_form',[
				'travel_agent_list'		=> $all_travel_agents,
				'destination_list'		=> $all_destinations,
				'departure_list'		=> $departure_list,
				'budget_list'			=> $budget_list,
				'default_filter_travel_agent'	=> $travel_agent->slug,
				'default_filter_tujuan'			=> $tujuan->path_slug,
				'default_filter_keberangkatan'	=> $keberangkatan['year'].$keberangkatan['month'],
				'default_filter_budget'			=> $budget['min'].'-'.$budget['max']
			]) --}}
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class='mt-sm text-uppercase text-lg text-center'>
				{{ $tour->name }}
				<br><small>{{ $tour_schedule->departure->format('d M Y') }}</small>
			</h1>

			<hr class='border-1 border-black'>

			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<p class='text-center'>
						<img src="{{$tour->travel_agent->images->where('name', 'LargeLogo')->first()->path}}">
						<br><strong class='text-lg text-light'>{{$tour->travel_agent->name}}</strong>
						<br>{{nl2br($tour->travel_agent->address)}}

						<div class="clearfix">
							<div class='fa fa-phone pull-left'></div>
							Untuk Reservasi Hub:
							<br>{{$tour->travel_agent->phone}}
						</div>
					</p>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p>{{$tour->ittinary}}</p>

					@foreach ($tour->options as $x)
						{{$x->name}} {{$x->pivot->description}}
					@endforeach

				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<p class=' text-lg text-light'>{{$tour_schedule->currency}} {{number_format($tour_schedule->discounted_price,0,',','.')}}</p>
					@if ($tour_schedule->discounted_price < $tour_schedule->original_price)
						<p class=' text-lg text-light'><span class='text-strikethrough text-muted'>{{$tour_schedule->currency}} {{number_format($tour_schedule->original_price,0,',','.')}}</span></p>
					@endif

					<h4 class='text-uppercase'>Jadwal Keberangkatan Lainnya</h4>
					@if ($tour->schedules->count() > 1)
						@foreach ($tour->schedules as $x)
							<p>
								{{$x->departure->format('d-M-Y')}}
								<br>
								@if ($tour_schedule->discounted_price < $tour_schedule->original_price)
									<span class='text-strikethrough text-muted text-sm'>{{$tour_schedule->currency}} {{number_format($tour_schedule->original_price,0,',','.')}}</span>
								@endif
								{{$tour_schedule->currency}} {{number_format($tour_schedule->discounted_price,0,',','.')}}
							</p>
						@endforeach
					@endif
				</div>
			</div>

			<hr class='border-1 border-black'>

			{{-- OTHER TOUR BY DESTINATION --}}
			<div class="row mt-md">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-uppercase pt-xs">
					Tour Lainnya dengan Tujuan <strong>{{implode(', ', $tour->destinations->lists('long_name')->toArray()) }}</strong>
				</div>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					@include('web.v2.components.tours.data_table',[
								'tour_schedules'		=> $other_tours['by_destination'],
							])
					<hr>
					<p class='text-right'>
						<a href='{{route("web.tour", [])}}'>Lihat Semua</a>
					</p>
				</div>
			</div>

			{{-- OTHER TOUR BY DEPARTURE --}}
			<div class="row mt-md">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-uppercase pt-xs">
					Tour Lainnya dengan Keberangkatan sekitar <strong>{{$tour_schedule->departure->format('d M Y') }}</strong>
				</div>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					@include('web.v2.components.tours.data_table',[
								'tour_schedules'		=> $other_tours['by_departure'],
							])
					<hr>
					<p class='text-right'>
						<a href='{{route("web.tour", [])}}'>Lihat Semua</a>
					</p>
				</div>
			</div>

			{{-- OTHER TOUR BY BUDGET --}}
			<div class="row mt-md">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-uppercase pt-xs">
					Tour Lainnya dengan dengan budget <strong>{{$tour_schedule->currency}} {{number_format($tour_schedule->discounted_price * 80/100, 0, ',','.')}} - {{$tour_schedule->currency}} {{number_format($tour_schedule->discounted_price * 120/100, 0, ',','.')}} (+/- 20%)</strong>
				</div>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					@include('web.v2.components.tours.data_table',[
								'tour_schedules'		=> $other_tours['by_budget'],
							])
					<hr>
					<p class='text-right'>
						<a href='{{route("web.tour", [])}}'>Lihat Semua</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-md">
{{-- 			@include('web.v2.components.tours.data_table',[
				'tour_schedules'		=> $tour_schedules,
				'travel_agent_list'		=> $all_travel_agents,
				'destination_list'		=> $all_destinations,
				'departure_list'		=> $departure_list,
				'budget_list'			=> $budget_list,
			]) --}}
		</div>
	</div>

@stop