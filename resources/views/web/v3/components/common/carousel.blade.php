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
					<li data-slotamount="7" data-masterspeed="500" data-title="{{ $item->title }}">
						<img src="{{ $item->images->where('name', 'LargeImage')->first()->path }}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="{{ $item->title }}">

						<div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-1" data-x="500" data-y="230" data-speed="700" data-start="1500" data-easing="easeOutBack">
							{{ $item->title }}
						</div>

						<div class="tp-caption sfb fadeout slider-caption slider-caption-1" data-x="center" data-y="280" data-speed="700" data-easing="easeOutBack"  data-start="2000">
							{{ $item->description }}
						</div>
						
						<a href="#" class="tp-caption sfb fadeout awe-btn awe-btn-style3 awe-btn-slider" data-x="center" data-y="380" data-easing="easeOutBack" data-speed="700" data-start="2200">Lihat Detail</a>
					</li> 
				@endforeach
			</ul>
		</div>
	</section>
@endif