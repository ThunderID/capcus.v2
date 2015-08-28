<?php
	$required_variables = ['tour_schedule'];
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
			<img src="{{ $tour_schedule->tour->destinations->first()->images->where('name', 'LargeImage')->first()->path ? $tour_schedule->tour->destinations->first()->images->where('name', 'LargeImage')->first()->path : asset('images/no-img.jpg') }}" alt="{{ $tour_schedule->tour->name }}">
		</div>
	</div>
	<div class="item-body">
		<div class="item-title">
			<h2>
				<a href="{{ route('web.tour.show', ['travel_agent' => $tour_schedule->tour->travel_agent->slug, 'tour_slug' => $tour_schedule->tour->slug, 'schedule' => $tour_schedule->departure->format('Ymd') ]) }}">{{ $tour_schedule->tour->name }}</a>
			</h2>
		</div>
		<div class="item-list">
			{{ implode(', ', $tour_schedule->tour->places->name) }}
		</div>
		<div class="item-footer">
			<div class="item-icon">
				<img src="{{$tour_schedule->tour->travel_agent->images->where('name', '=', 'SmallLogo')->first()->path}}">
			</div>
		</div>
	</div>
	<div class="item-price-more">
		<div class="price">
			Mulai ({{ $tour_schedule->tour->cheapest->currency }})
			<ins>
				<span class="amount"> {{ number_format($tour_schedule->tour->cheapest->discounted_price , 0, ',', '.') }}</span>
			</ins>
			@if ($tour_schedule->tour->cheapest->discounted_price < $tour_schedule->tour->cheapest->original_price)
				<del>
					<span class="amount">{{ number_format($tour_schedule->tour->cheapest->original_price, 0,'.',',') }}</span>
				</del>
			@endif
	
		</div>
		<a href="{{ route('web.tour.show', ['travel_agent' => $tour_schedule->tour->travel_agent->slug, 'tour_slug' => $tour_schedule->tour->slug, 'schedule' => $tour_schedule->departure->format('Ymd') ]) }}" class="awe-btn">DETAIL</a>
	</div>
</div>
<!-- END / ITEM -->