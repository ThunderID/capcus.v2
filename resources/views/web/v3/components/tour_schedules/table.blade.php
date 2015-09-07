<?php
	$required_variables = ['tour_schedules'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ': ' . $x . ": Required", 1);
		}
	}
?>

<div class='hidden-lg hidden-md hidden-sm mt-0 mb-sm'>
	Urutkan berdasarkan {!! Form::select('sort_by', ['Tgl Keberangkatan', 'Travel Agent', 'Tujuan', 'Hari', 'Harga'], '', ['style' => 'width:100%', 'id' => 'select_sort_tour_result']) !!}
</div>

<table class="table table-hover tour_schedule_table table-sorter">
	<thead>
		<tr>
			<th title="klik untuk mengurutkan" class='text-uppercase hidden-xs'>Tgl <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" class='text-uppercase text-center hidden-xs'>Oleh <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" class='text-uppercase '>
				<span class='hidden-xs'>Tujuan</span>
				<span class='hidden-sm hidden-md hidden-lg'>PAKET TOUR</span>
				<div class='icon'></div>
			</th>
			<th title="klik untuk mengurutkan" class='text-uppercase hidden-xs'>Hari <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" class='text-uppercase text-right hidden-xs'>Harga <div class='icon'></div></th>
		</tr>
	</thead>
	<tbody>
		@forelse ($tour_schedules as $schedule)
			<?php
				switch (strtolower($schedule->tour->travel_agent->active_packages[0]->name))
				{
					case 'diamond'	: $tr_class 	= 'bg-diamond'; break;
					case 'gold'		: $tr_class 	= 'bg-gold'; break;
					case 'silver'	: $tr_class 	= 'bg-silver'; break;
					case 'bronze'	: $tr_class 	= 'bg-bronze'; break;
					default			: $tr_class 	= ''; break;
				}
			?>
			{{-- GENERATE CLASS --}}
			<tr class='text-regular {{ ($schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"") }} {{ $tr_class }}'
						data-duration="{{ $schedule->tour->duration_day * 1 }}"
						data-price="{{ $schedule->discounted_price * 1 }}"
						data-travel-agent="{{ $schedule->tour->travel_agent->id }}"
						data-link="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}"
				>
				<td class='pt-md pb-lg text-left hidden-xs' height=60 data-sort-value="{{$schedule->departure->format('Ymd')}}" width='150'>
					@if (is_null($schedule->departure_until))
						{{ $schedule->departure->format('d-m-Y')}}
					@else
						<span class='text-sm'>
							Kapanpun antara
							<br><span class="">{{ $schedule->departure->format('d-m-Y')}} s/d <br>{{ $schedule->departure_until->format('d-m-Y')}}</span>
						</span>
					@endif
				</td>
				<td class='pt-md pb-lg text-center hidden-xs' data-sort-value="{{$schedule->tour->travel_agent->name}}" width="90">
					<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs mt-5'>
				</td>
				<td class='pt-md pb-lg text-left' data-sort-value="{{$schedule->tour->destinations[0]->long_name}}">
					{{-- DESKTOP --}}
					<div class='hidden-xs'>
						<strong class='text-uppercase text-md mb-sm'>{{ implode(', ', $schedule->tour->destinations->lists('name')->toArray()) }}</strong>
						@if (!$hide_places)
							<p class='mt-sm tour_schedule_places_detail'><span class=''>{{ implode(', ', $schedule->tour->places->lists('name')->toArray()) }}</span></p>
						@endif

						@if (!$hide_options)
							<div class='mt-xs tour_schedule_paket_detail'>
								@include('web.v3.components.tour_options.table_for_tour_schedule', ['tour_schedule' => $schedule])
							</div>
						@endif

						<div class='mt-md'>					
							<a href="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}" class='awe-btn awe-btn-style2'>Detail</a>
							<a href="javascript:;" data-id='{{$schedule->id}}' class='awe-btn {{ in_array( $schedule->id, Session::get('compare_cart')) ? '': 'awe-btn-style2'}} compare_tour add'>
								<i class='fa fa-check {{ in_array( $schedule->id, Session::get('compare_cart')) ? '': 'hidden'}}'></i> Bandingkan
							</a>
						</div>

					</div>

					<div class='hidden-sm hidden-md hidden-lg'>
						<h2 class='text-uppercase text-md text-bold'>{{ implode(', ', $schedule->tour->destinations->lists('long_name')->toArray()) }}</h2>
						@if (!$hide_places)
							<p class='tour_schedule_places_detail'>{{ implode(', ', $schedule->tour->places->lists('name')->toArray()) }}</p>
						@endif 
						
						<table class="table bg-transparent mt-lg">
							<tbody>
								<tr>
									<td style='width:30% !important'>Keberangkatan</td>
									<td>
										@if (is_null($schedule->departure_until))
											{{ $schedule->departure->format('d-m-Y')}}
										@else
											<span class='text-sm'>
												Kapanpun antara {{ $schedule->departure->format('d-m-Y')}} s/d {{ $schedule->departure_until->format('d-m-Y')}}
											</span>
										@endif
									</td>
								</tr>
								<tr>
									<td>Travel Agent</td>
									<td><img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs'></td>
								</tr>
								<tr>
									<td>Hari</td>
									<td>{{ $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N'}}</td>
								</tr>
								<tr>
									<td>Harga</td>
									<td>
										{{ $schedule->currency . ' ' . number_format($schedule->discounted_price, 0, ',','.')}}
										@if ($schedule->discounted_price < $schedule->original_price)
											<br>
											<span class='text-strikethrough text-primary'>
												<span class='text-light text-gray'>{{ $schedule->currency . ' ' . number_format($schedule->original_price, 0, ',','.')}}</span>
											</span>
										@endif
									</td>
								</tr>
								@if (!$hide_options)
									<tr class='tour_schedule_paket_detail'>
										<td>Inc/Exc</td>
										<td>
											@include('web.v3.components.tour_options.table_for_tour_schedule', ['tour_schedule' => $schedule])
										</td>
									</tr>
								@endif

							</tbody>
						</table>

						<div class='mt-md text-center'>
							<a href="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}" class='awe-btn awe-btn-style2'>Detail</a>
							<a href="javascript:;" data-id='{{$schedule->id}}' class='awe-btn {{ in_array( $schedule->id, Session::get('compare_cart')) ? '': 'awe-btn-style2'}} compare_tour add'>
								<i class='fa fa-check {{ in_array( $schedule->id, Session::get('compare_cart')) ? '': 'hidden'}}'></i> Bandingkan
							</a>
						</div>
					</div>
				</td>

				<td class='pt-md pb-lg text-left hidden-xs' data-sort-value="{{$schedule->tour->duration_day}}" width="90">{{ $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N'}}</td>
				<td class='pt-md pb-lg text-right hidden-xs' data-sort-value="{{$schedule->discounted_price}}" width="100">
					{{ $schedule->currency . ' ' . number_format($schedule->discounted_price, 0, ',','.')}}
					@if ($schedule->discounted_price < $schedule->original_price)
						<br>
						<span class='text-strikethrough text-primary pr-5'>
							<span class='text-light text-gray'>{{ $schedule->currency . ' ' . number_format($schedule->original_price, 0, ',','.')}}</span>
						</span>
					@endif

				</td>
{{-- 				<td>
					<a href="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}">Detail <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</td> --}}
			</tr>
		@empty
			<tr class='text-regular'>
				<td colspan='7' class='text-center'>Saat ini belum ada paket tour seperti yang anda inginkan. Silahkan cari paket tour lainnya</td>
			</tr>
		@endforelse
	</tbody>
</table>

@section('js')
	@parent

	{!! Html::script('plugins/jquery-tablesorter/jquery.tablesorter.min.js') !!}
	{!! HTML::script('plugins/selectize/js/standalone/selectize.min.js') !!}

	<script>

		$(document).ready(function(){
			$('.tour_schedule_table > tbody.clickable').on('click', 'tr', function(event) {
				window.location = $(this).data('link');
			});

			// add parser through the tablesorter addParser method 
			$.tablesorter.addParser({ 
				// set a unique id 
				id: 'data_value_text', 
				is: function(s) { 
					// return false so this parser is not auto detected 
					return false; 
				}, 
				format: function(s, table, cell, cellindex) { 
					return (cell.getAttribute('data-sort-value'));
				}, 
				// set type, either numeric or text 
				type: 'text' 
			}); 

			$.tablesorter.addParser({ 
				// set a unique id 
				id: 'data_value_numeric', 
				is: function(s) { 
					// return false so this parser is not auto detected 
					return false; 
				}, 
				format: function(s, table, cell, cellindex) { 
					return (cell.getAttribute('data-sort-value'));
				}, 
				// set type, either numeric or numeric 
				type: 'numeric' 
			}); 

			$('.table-sorter').tablesorter({
				headers: {
					0: { sorter: 'data_value_numeric'},
					1: { sorter: 'data_value_text'},
					2: { sorter: 'data_value_text'},
					3: { sorter: 'data_value_numeric'},
					4: { sorter: 'data_value_numeric'}
				},
				// sortList: [[0,0]]
			});
		})
	
		$('#select_sort_tour_result').on('change', function(event) {
			var select = $(this);
			$('.table-sorter').find('th:eq('+(select.val())+')').trigger('sort');
		});




			
	</script>
@stop