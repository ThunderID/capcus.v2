<?php
	$required_variables = ['tour'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.home.homegrids: ' . $x . ": Required", 1);
		}
	}
?>

<div class="thumbnail trip-item">
	<img src="{{ ($tour->places->count() && $tour->places->first()->images->where('name', 'SmallImage')->first()->path ? $tour->places->first()->images->where('name', 'SmallImage')->first()->path : asset('images/no-img.jpg'))  }}" alt="{{ $tour->name }}" class="trip_thumbnail">
	<div class="caption">
		<div class='ml-xs mr-xs'>
			<img src="{{ $tour->travel_agent->images->where('name','SmallLogo')->first()->path }}" width="50" class='pull-right mt-5'>
		
			<h3>{{ $tour->name }}</h3>
			<p>{{ implode(', ', $tour->places->lists('name')->toArray()) }}</p>

			<div class="text-center mb-md mt-lg text-gray">
				Mulai 
				<div class="price"> 
					{{ $tour->schedules->sortby('discounted_price')->first()->currency }} {{ number_format($tour->schedules->sortby('discounted_price')->first()->discounted_price , 0, ',', '.') }}
				</div>
				@if ($tour->schedules->sortby('discounted_price')->first()->discounted_price < $tour->schedules->sortby('discounted_price')->first()->original_price)
					<div class="price"> 
						<del>{{ $tour->schedules->sortby('discounted_price')->first()->currency }} {{ number_format($tour->schedules->sortby('discounted_price')->first()->original_price, 0,'.',',') }}</del>
					</div>
				@endif
			</div>
		</div>

		<a href="{{ route('web.tour.show', ['travel_agent' => $tour->travel_agent->slug, 'tour_slug' => $tour->slug, 'schedule' => ($tour->cheapest ? $tour->cheapest->departure->format('Ymd') : $tour->schedules->first()->departure->format('Ymd')) ]) }}" class="btn btn-default btn-yellow-no-border btn-block">DETAIL</a>
	</div>
</div>
