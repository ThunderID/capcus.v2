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
			<img src="{{ $tour->destinations->first()->images->where('name', 'LargeImage')->first()->path }}" alt="{{ $tour->name }}">
		</div>
		<div class="trip-icon">
		</div>
	</div>
	<div class="item-body">
		<div class="item-title">
			<h2>
				<a href="#">{{ $tour->name }}</a>
			</h2>
		</div>
		<div class="item-list">
			{{ implode(', ', $tour->places->name) }}
		</div>
		<div class="item-footer">
			<div class="item-rate">
			</div>
			<div class="item-icon">
				<i class="awe-icon awe-icon-gym"></i>
				<i class="awe-icon awe-icon-car"></i>
				<i class="awe-icon awe-icon-food"></i>
				<i class="awe-icon awe-icon-level"></i>
				<i class="awe-icon awe-icon-wifi"></i>
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
		<a href="#" class="awe-btn">DETAIL</a>
	</div>
</div>
<!-- END / ITEM -->