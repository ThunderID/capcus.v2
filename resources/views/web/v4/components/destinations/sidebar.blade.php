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
	<?php $i= 0; ?>
	@foreach ($top_destinations as $x)
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class='pt-xs pb-xs bg-yellow pull-left text-center mr-sm'>
				<div class='mr-sm ml-sm text-lg text-black'>{{++$i}}</div>
			</div>
			<a class='text-uppercase text-black' href='{{ route("web.tour", ["travel-agent" => "semua-travel-agent", "tujuan" => $x->path_slug]) }}'>
				<p class='mb-sm'>
					<span class=' text-lg'>{{$x->name}}</span>
					<br>{{$x->total_upcoming_schedules}} Paket Tour
				</p>
			</a>
			<hr class='mt-5 mb-sm'>
		</div>
	@endforeach
</div>