<?php
	$required_variables = ['promo_tours', 'latest_tours'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.home.tour_tabs: ' . $x . ": Required", 1);
		}
	}
?>
<div class="tabs">
	<ul>
		<li><a href="#promo-tours">PROMO</a></li>
		<li><a href="#latest_tours">TERBARU</a></li>
	</ul>
	<div class="tabs__content">
		<div id="promo-tours">
			@foreach ($promo_tours as $tour)
				@include('web.v3.components.tour_schedules.tour_schedule_item', ['tour_schedule' => $tour])
			@endforeach
		</div>
		<div id="latest_tours">
			@foreach ($latest_tours as $tour)
				@include('web.v3.components.tours.tour_item', ['tour' => $tour])
			@endforeach
		</div>
	</div>
</div>
