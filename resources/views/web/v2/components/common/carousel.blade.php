<?php
	$required_variables = ['carousel_items'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.common.carousel: ' . $x . ": Required", 1);
		}
	}
?>

@if ($carousel_items && $carousel_items->count())
	<div id="carousel-id" class="carousel slide headline" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach ($carousel_items as $k => $item)
				<li data-target="#carousel-id" data-slide-to="{{$k}}" class="{{ $k == 0 ? 'active' : ''}}"></li>
			@endforeach
		</ol>
		<div class="carousel-inner">
			@foreach ($carousel_items as $k => $item)
				<div class="item {{$k == 0 ? 'active' : ''}}">
					<a href='{{ $item->link_to }}'>
						<img data-src="{{ $item->images->where('name', 'LargeImage')->first()->path }}" alt="{{ $item->title }}" src="{{ $item->images->where('name', 'LargeImage')->first()->path }}" width='100%'>
					</a>
				</div>
			@endforeach
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
@endif


