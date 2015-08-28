<?php
	$required_variables = ['tour_schedules'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.home.homegrids: ' . $x . ": Required", 1);
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
			<th title="klik untuk mengurutkan" class='text-uppercase text-center hidden-xs'>Travel Agent <div class='icon'></div></th>
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
					case 'diamond': $tr_class 	= 'bg-diamond'; break;
					case 'gold': $tr_class 		= 'bg-gold'; break;
					case 'silver': $tr_class 	= 'bg-silver'; break;
					case 'bronze': $tr_class 	= 'bg-bronze'; break;
					default: $tr_class = ''; break;
				}
			?>
			{{-- GENERATE CLASS --}}
			<tr class='text-regular {{ ($schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"") }} {{ $tr_class }}'
						data-duration="{{ $schedule->tour->duration_day * 1 }}"
						data-price="{{ $schedule->discounted_price * 1 }}"
						data-travel-agent="{{ $schedule->tour->travel_agent->id }}"
						data-link="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}"
				>
				<td class='text-left hidden-xs' height=60 data-sort-value="{{$schedule->departure->format('Ymd')}}">
					@if (is_null($schedule->departure_until))
						{{ $schedule->departure->format('d-m-Y')}}
					@else
						<span class='text-sm'>
							Kapanpun antara
							<br>{{ $schedule->departure->format('d-m-Y')}} s/d {{ $schedule->departure_until->format('d-m-Y')}}
						</span>
					@endif
				</td>
				<td class='text-center hidden-xs' data-sort-value="{{$schedule->tour->travel_agent->name}}">
					<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs'>
				</td>
				<td class='text-left' data-sort-value="{{$schedule->tour->destinations[0]->long_name}}">
					<div class='hidden-xs'>
						<strong class='text-uppercase'>{{ implode(', ', $schedule->tour->destinations->lists('long_name')->toArray()) }}</strong>
						{{ implode(', ', $schedule->tour->places->lists('name')->toArray()) }}
						<p>
						@foreach ($schedule->tour->options as $option)
							<li>
								{{$option->name}} <br>
								{{$option->description}}
							</li>
						@endforeach
						</p>
					</div>

					<div class='hidden-sm hidden-md hidden-lg'>
						<h2 class='text-uppercase text-md text-bold'>{{ implode(', ', $schedule->tour->destinations->lists('long_name')->toArray()) }}</h2>

						<table class="table">
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
							</tbody>
						</table>
					</div>
				</td>

				<td class='text-left hidden-xs' data-sort-value="{{$schedule->tour->duration_day}}">{{ $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N'}}</td>
				<td class='text-right hidden-xs' data-sort-value="{{$schedule->discounted_price}}">
					{{ $schedule->currency . ' ' . number_format($schedule->discounted_price, 0, ',','.')}}
					@if ($schedule->discounted_price < $schedule->original_price)
						<br>
						<span class='text-strikethrough text-primary'>
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
			$('.tour_schedule_table > tbody').on('click', 'tr', function(event) {
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
		// $('#select_sort_tour_result')[0].selectize.on('change', function(event) {
		// 	var select = $('#select_sort_tour_result')[0].selectize;
		// 	alert(select.getValue());
		// });
			
	</script>
@stop