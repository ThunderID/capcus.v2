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

<div id="slider" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach ($carousel_items as $k => $i)
			<li data-target="#slider" data-slide-to="{{$k}}" class="{{ $k == 0 ? 'active' : ""}}"></li>
		@endforeach
	</ol>
	<div class="carousel-inner">
		@foreach ($carousel_items as $k => $item)
			<div class="item {{$k == 0 ? 'active' : ''}}">
				<img src='{{ $item->images->where('name', 'LargeImage')->first()->path }}' class='fullwidth' data-link="{{ $item->link_to }}" style='cursor:pointer'>
			</div>
		@endforeach
	</div>
	<a class="left carousel-control" href="#slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
