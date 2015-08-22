<?php
	$required_variables = ['carousel_items'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.carousel: ' . $x . ": Required", 1);
		}
	}
?>

@if (($carousel_items instanceOf \Illuminate\Support\Collection) && $carousel_items->count())
	<section class="hero-section">
		<div id="slider-revolution">
			<ul>
				@foreach ($carousel_items as $item)
					<li data-slotamount="7" data-masterspeed="500" data-title="{{ $item->title }}" data-link="{{ $item->link_to }}" style='cursor:pointer'>
						<img src="{{ $item->images->where('name', 'LargeImage')->first()->path }}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="{{ $item->title }}">
					</li> 
				@endforeach
			</ul>
		</div>
	</section>
@endif