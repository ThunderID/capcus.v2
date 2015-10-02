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
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<p class='mb-lg'>
				<a class='text-uppercase text-black' href='{{ route("web.tour", ["travel-agent" => "semua-travel-agent", "tujuan" => $x->path_slug]) }}'>
					{{$x->iamges}}
					{!! Html::image($x->images->where('name', 'SmallImage')->first()->path, $x->long_name, ['width' => '100%', 'class' => 'image43']) !!}	
					<p class='mt-5'>{{$x->name}}</p>
				</a>
			</p>
		</div>
	@endforeach
</div>