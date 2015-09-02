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


<!-- ITEM -->
<div class="trip-item">
	<div class="item-media">
		<div class="image-cover">
			<img src="{{ ($tour->destinations->first()->images->where('name', 'LargeImage')->first()->path ? $tour->destinations->first()->images->where('name', 'LargeImage')->first()->path : asset('images/no-img.jpg'))  }}" alt="{{ $tour->name }}">
		</div>
	</div>
	<div class="item-body">
		<div class="item-title">
			<img src="{{ $tour->travel_agent->images->where('name','SmallLogo')->first()->path }}" width="50" class='pull-right mt-5'>
			<h2>
				<a href="{{ route('web.tour.show', ['travel_agent' => $tour->travel_agent->slug, 'tour_slug' => $tour->slug, 'schedule' => ($tour->cheapest ? $tour->cheapest->departure->format('Ymd') : $tour->schedules->first()->departure->format('Ymd')) ]) }}">{{ $tour->name }}</a>
			</h2>
		</div>
		<div class="item-list mt-sm">
			{{ implode(', ', $tour->places->lists('long_name')->toArray()) }}
		</div>
		<div class="item-footer">
			<div class="item-icon">
				<img src="{{$tour->travel_agent->images->where('name', '=', 'SmallLogo')->first()->path}}">
			</div>
		</div>
	</div>
	<div class="item-price-more">
		<div class="price">
			Mulai ({{ $tour->schedules->sortby('discounted_price')->first()->currency }})
			<ins>
				<span class="amount"> {{ number_format($tour->schedules->sortby('discounted_price')->first()->discounted_price , 0, ',', '.') }}</span>
			</ins>
			@if ($tour->schedules->sortby('discounted_price')->first()->discounted_price < $tour->schedules->sortby('discounted_price')->first()->original_price)
				<del>
					<span class="amount">{{ number_format($tour->schedules->sortby('discounted_price')->first()->original_price, 0,'.',',') }}</span>
				</del>
			@endif
	
		</div>
		<a href="{{ route('web.tour.show', ['travel_agent' => $tour->travel_agent->slug, 'tour_slug' => $tour->slug, 'schedule' => ($tour->cheapest ? $tour->cheapest->departure->format('Ymd') : $tour->schedules->first()->departure->format('Ymd')) ]) }}" class="awe-btn">DETAIL</a>
	</div>
</div>
<!-- END / ITEM -->