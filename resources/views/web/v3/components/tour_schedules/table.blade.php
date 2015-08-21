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

<table class="table table-hover tour_schedule_table">
	<thead>
		<tr>
			<th class='text-uppercase'>Tgl</th>
			<th class='text-uppercase text-center'>Travel Agent</th>
			<th class='text-uppercase'>Tujuan</th>
			<th class='text-uppercase'>Durasi</th>
			<th class='text-uppercase text-right'>Harga</th>
		</tr>
	</thead>
	<tbody>
		@forelse ($tour_schedules as $schedule)
			{{-- GENERATE CLASS --}}
			<tr class='text-regular {{ ($schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"") }}'
						data-duration="{{ $schedule->tour->duration_day * 1 }}"
						data-price="{{ $schedule->discounted_price * 1 }}"
						data-travel-agent="{{ $schedule->tour->travel_agent->id }}"
						data-link="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}"
				>
				<td class='text-left' height=60>{{ $schedule->departure->format('d-M-Y')}}</td>
				<td class='text-center'>
					<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs'>
				</td>
				<td class='text-left'>
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
				<td class='text-left'>{{ $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N'}}</td>
				<td class='text-right'>
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
	<script>
		$('.tour_schedule_table').on('click', 'tr', function(event) {
			window.location = $(this).data('link');
		});

		$('')
			
	</script>
@stop