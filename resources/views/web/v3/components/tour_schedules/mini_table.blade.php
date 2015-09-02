<?php
	$required_variables = ['tour_schedules'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ': ' . $x . ": Required", 1);
		}
	}
?>

@foreach ($tour_schedules as $schedule)
	<div class="row">
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<img src="{{ $schedule->tour->travel_agent->images->where('name', "SmallLogo")->first()->path}}" alt='{{ $schedule->tour->travel_agent->name}}' width="50" class='mr-xs mt-5'>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		</div>
	</div>
@endforeach