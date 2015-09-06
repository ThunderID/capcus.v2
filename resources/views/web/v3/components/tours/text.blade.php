<?php
	$required_variables = ['tours'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ":" . $x . ": Required", 1);
		}
	}

?>

<div class="row">
	@forelse ($tours as $x)
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<img src="{{$x->travel_agent->images->where('name', 'SmallLogo')->first()->path }}" class='pull-right mt-5' style='max-width:60px; max-height:40px;'>
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<a href="{{route('web.tour.show', ['travel_agent' => $x->travel_agent->slug, 
														'tour' => $x->slug, 
														'schedule' => ($x->cheapest ? $x->cheapest->departure->format('Ymd') : $x->schedules->first()->departure->format('Ymd'))
													 ])}}" class='text-black text-hover-yellow'>
						{{$x->name}}
					</a>
					<p>Mulai {{ $x->cheapest ? $x->cheapest->currency . ' ' . number_format($x->cheapest->discounted_price) : $x->schedules->first()->currency . ' ' . number_format($x->schedules->first()->discounted_price)}}
					<p><a href="{{route('web.tour.show', ['travel_agent' => $x->travel_agent->slug, 
														'tour' => $x->slug, 
														'schedule' => ($x->cheapest ? $x->cheapest->departure->format('Ymd') : $x->schedules->first()->departure->format('Ymd'))
													 ])}}" class='awe-btn awe-btn-style2'>Lihat Detail</a>
				</div>
			</div>

			<hr>
		</div>
	@empty
	@endforelse
</div>
