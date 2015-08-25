<?php
	$required_variables = ['destinations'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.destinations.sidebar: ' . $x . ": Required", 1);
		}
	}
?>

<div class="row">
	@foreach ($top_destinations as $x)
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{!! Html::image($x->images->where('name', 'SmallImage')->first()->path, $x->long_name, ['width' => '100%']) !!}	
			<a class='text-uppercase' href='{{ route("web.tour", ["travel-agent" => "semua-travel-agent", "tujuan" => $x->path_slug]) }}'>{{$x->long_name}}</a>
			<hr class='border-dotted border-bottom-2'>
		</div>
	@endforeach
</div>