<?php
	$required_variables = ['tours', 'colcount_xs', 'colcount_sm', 'colcount_md', 'colcount_lg'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ":" . $x . ": Required", 1);
		}
	}

	if (12 % $colcount_xs != 0)
	{
		throw new Exception($widget_name . ": colcount_xs : must be a factor of 12", 1);
	}

	if (12 % $colcount_sm != 0)
	{
		throw new Exception($widget_name . ": colcount_sm : must be a factor of 12", 1);
	}

	if (12 % $colcount_md != 0)
	{
		throw new Exception($widget_name . ": colcount_md : must be a factor of 12", 1);
	}

	if (12 % $colcount_lg != 0)
	{
		throw new Exception($widget_name . ": colcount_lg : must be a factor of 12", 1);
	}

	$col_xs = 12 / $colcount_xs;
	$col_sm = 12 / $colcount_sm;
	$col_md = 12 / $colcount_md;
	$col_lg = 12 / $colcount_lg;
?>

<div class="row">
	@forelse ($tours as $x)
		<div class="col-xs-{{$col_xs}} col-sm-{{$col_sm}} col-md-{{$col_md}} col-lg-{{$col_lg}}">
			<a href="{{route('web.tour.show', ['travel_agent' => $x->travel_agent->slug, 
												'tour' => $x->slug, 
												'schedule' => ($x->cheapest ? $x->cheapest->departure->format('Ymd') : $x->schedules->first()->departure->format('Ymd'))
											 ])}}">
				{!! Html::image($x->destinations->first()->images->where('name', 'MediumImage')->first()->path, $x->name, ['class' => 'image43 fullwidth']) !!}
				<p>{{$x->name}}</p>
			</a>
		</div>
	@empty
	@endforelse
</div>
