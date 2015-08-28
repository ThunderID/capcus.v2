<?php
	$required_variables = ['tour_schedules'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.tours.data_table: ' . $x . ": Required", 1);
		}
	}
?>

<table class="table table-hover">
	<thead>
		<tr>
			<th class='text-uppercase'>Tgl</th>
			<th class='text-uppercase'>Travel Agent</th>
			<th class='text-uppercase'>Durasi</th>
			<th class='text-uppercase text-right'>Harga</th>
			<th class='text-uppercase'>Tujuan</th>
			<th class='text-uppercase'>Keterangan</th>
			<th class='text-uppercase'></th>
		</tr>
	</thead>
	<tbody>
		@forelse ($tour_schedules as $schedule)
			<tr class='text-regular {{ $schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"" }}' >
				<td class='text-left' height=60>{{ $schedule->departure->format('d-M-Y')}}</td>
				<td class='text-left'>
					<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs'>
					{{ $schedule->tour->travel_agent->name}}
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
				<td class='text-left'>
					<strong class='text-uppercase'>{{ implode(', ', $schedule->tour->destinations->lists('long_name')->toArray()) }}</strong>
					{{ implode(', ', $schedule->tour->places->lists('name')->toArray()) }}
				</td>
				<td class='text-left'>
					@foreach ($schedule->tour->options as $option)
						<li>
							{{$option->name}} <br>
							{{$option->description}}
						</li>
					@endforeach
				</td>
				<td>
					<a href="{{route('web.tour.show', ['travel_agent' => $schedule->tour->travel_agent->slug, 'tour_slug' => $schedule->tour->slug, 'schedule' => $schedule->departure->format('Ymd')])}}">Detail <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</td>
			</tr>
		@empty
			<tr class='text-regular'>
				<td colspan='7' class='text-center'>Saat ini belum ada paket tour seperti yang anda inginkan. Silahkan cari paket tour lainnya</td>
			</tr>
		@endforelse
	</tbody>
</table>