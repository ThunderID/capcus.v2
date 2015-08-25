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

<div role="tabpanel" class="bs-tab-yellow-border">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#tour_promo" aria-controls="home" role="tab" data-toggle="tab">Promo</a>
        </li>
        <li role="presentation">
            <a href="#tour_terbaru" aria-controls="tab" role="tab" data-toggle="tab">Terbaru</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tour_promo">
        	@foreach ($promo_tours as $tour)
				@include('web.v3.components.tour_schedules.tour_schedule_item', ['tour_schedule' => $tour])
			@endforeach
        </div>
        <div role="tabpanel" class="tab-pane" id="tour_terbaru">
        	@foreach ($latest_tours as $tour)
				@include('web.v3.components.tours.tour_item', ['tour' => $tour])
			@endforeach
        </div>
    </div>
</div>
