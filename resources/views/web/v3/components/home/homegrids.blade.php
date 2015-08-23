<?php
	$required_variables = ['homegrids'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.home.homegrids: ' . $x . ": Required", 1);
		}
	}
?>

<!-- MASONRY -->
{{-- <div class='destination-grid-content'>
	<div class="row">
		<div class="awe-masonry">
			<!-- GALLERY ITEM -->
			@foreach ($homegrids as $x)
				<div class="awe-masonry__item">
					<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug]) }}">
						<div class="image-wrap image-cover">
							<img src="{{ $x->image_url }}" alt="{{ $x->title }}">
						</div>
					</a>
					<div class="item-title">
						<h2><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{$x->title}}</a></h2>
						<div class="item-cat">
							<ul>
								<li><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{ $x->destination_detail->long_name}}</a></li>
							</ul>
						</div>
					</div>
					<div class="item-available">
						@if (str_is('destination', $x->type) || str_is('featured_destination', $x->type))
							<span class="count">{{ $x->destination_detail->total_upcoming_schedules }}</span>
							paket tour
						@endif
					</div>
				</div>
			@endforeach
			<!-- END / GALLERY ITEM -->
		</div>

		<div class="clearfix"></div>

		
	</div>
</div> --}}

<!-- END / MASONRY -->

<div class="row">
	@foreach ($homegrids as $x)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-lg">
			<div class='grid_item'>
				<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug]) }}">
					<img src="{{ $x->image_url }}" alt="{{ $x->title }}">
				</a>
				<div class="item-title">
					<h2><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{$x->title}}</a></h2>
					<div class="item-cat">
						<ul>
							<li><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{ $x->destination_detail->long_name}}</a></li>
						</ul>
					</div>
				</div>
				@if (str_is('featured_destination', $x->type))
					<div class='item-featured bg-yellow text-black text-uppercase'>
						Featured
					</div>
				@endif
				<div class="item-available">
					@if (str_is('destination', $x->type) || str_is('featured_destination', $x->type))
						<a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}" class='text-white'>
							<span class="count">{{ $x->destination_detail->total_upcoming_schedules }}</span>
							paket tour
						</a>
					@endif
				</div>
			</div>
		</div>
	@endforeach

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-lg mb-xxl">
		<a href="{{ route('web.tour')}}" class='text-uppercase btn btn-yellow btn-block btn-lg text-light text-md'>Lihat Semua Paket Tour</a>
	</div>
</div>