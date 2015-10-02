<?php
	$required_variables = ['carousel_items'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ':' . $x . ": Required", 1);
		}
	}
?>


@foreach ($carousel_items as $k => $item)
	<div>
		<img src='{{ $item->images->where('name', 'LargeImage')->first()->path }}' class='fullwidth' data-link="{{ $item->link_to }}" style='cursor:pointer'>
	</div>
@endforeach
