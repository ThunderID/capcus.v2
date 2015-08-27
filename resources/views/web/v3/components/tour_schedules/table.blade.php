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

<table class="table table-hover tour_schedule_table table-sorter">
	<thead>
		<tr>
			<th title="klik untuk mengurutkan" width='5%' class='text-uppercase'>Tgl <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" width='5%' class='text-uppercase text-center'>Travel Agent <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" width='5%' class='text-uppercase'>Tujuan <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" width='5%' class='text-uppercase'>Hari <div class='icon'></div></th>
			<th title="klik untuk mengurutkan" width='5%' class='text-uppercase text-right'>Harga <div class='icon'></div></th>
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
				<td class='text-left' height=60 data-sort-value="{{$schedule->departure->format('Ymd')}}">
					@if (is_null($schedule->departure_until))
						{{ $schedule->departure->format('d-m-Y')}}
					@else
						<span class='text-sm'>
							Kapanpun antara
							<br>{{ $schedule->departure->format('d-m-Y')}} s/d {{ $schedule->departure_until->format('d-m-Y')}}
						</span>
					@endif
				</td>
				<td class='text-center' data-sort-value="{{$schedule->tour->travel_agent->name}}">
					<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs'>
				</td>
				<td class='text-left' data-sort-value="{{$schedule->tour->name}}">
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
				</td>
				<td class='text-left' data-sort-value="{{$schedule->tour->duration_day}}">{{ $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N'}}</td>
				<td class='text-right' data-sort-value="{{$schedule->discounted_price}}">
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
			
	</script>
@stop