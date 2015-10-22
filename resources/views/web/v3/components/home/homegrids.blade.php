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

<div class="row">
	@foreach ($homegrids as $x)
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-lg">
			<div class="{{ str_is('capcus*choice', strtolower($x->label)) ? 'grid_item_special' : 'grid_item'}}">
				{{-- DESTINATION --}}
				@if (str_is('destination', $x->type))
					<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug]) }}">
						<img src="{{ $x->image_url }}" alt="{{ $x->title }}" class='fullwidth'>
					</a>
					<div class="item-title">
						@if ($x->show_title !== false)
							<h2><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{$x->title}}</a></h2>
						@endif
						<div class="item-cat">
							<ul>
								<li><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $x->destination_detail->path_slug])}}">{{ $x->destination_detail->long_name}}</a></li>
							</ul>
						</div>
					</div>
					@if (trim($x->label))
						<div class='item-featured bg-yellow text-black text-uppercase'>
							{{ $x->label }}
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
				{{-- TAG --}}
				@elseif (str_is('tour_tags', $x->type))
					<a href="{{ route('web.tour.tag', ['tag' => $x->tag_detail->tag]) }}">
						<img src="{{ $x->image_url }}" alt="{{ $x->title }}" class='fullwidth'>
					</a>
					<div class="item-title">
						@if ($x->show_title !== false)
							<h2><a href="{{ route('web.tour.tag', ['tag' => $x->tag_detail->tag])}}">{{$x->title}}</a></h2>
						@endif
						<div class="item-cat">
							<ul>
								<li><a href="{{ route('web.tour.tag', ['tag' => $x->tag_detail->tag])}}">#{{ $x->tag_detail->tag}}</a></li>
							</ul>
						</div>
					</div>
					@if (trim($x->label))
						<div class='item-featured bg-yellow text-black text-uppercase'>
							{{ $x->label }}
						</div>
					@endif
					<div class="item-available">
						<a href="{{ route('web.tour.tag', ['tag' => $x->tag_detail->tag])}}" class='text-white'>
							<span class="count">{{ $x->tag_detail->total_upcoming_schedules }}</span>
							paket tour
						</a>
					</div>
				@elseif (str_is('link', $x->type))
					<a href="{{ $x->link }}">
						<img src="{{ $x->image_url }}" alt="{{ $x->title }}" class='fullwidth'>
					</a>
					<div class="item-title">
						@if ($x->show_title !== false)
							<h2><a href="{{ $x->link }}">{{$x->title}}</a></h2>
						@endif
					</div>
					@if ($x->label)
						<div class='item-featured bg-yellow text-black text-uppercase'>
							{{ $x->label }}
						</div>
					@endif
				@endif
			</div>
		</div>
	@endforeach

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-lg mb-xxl">
		<a href="{{ route('web.tour')}}" class='text-uppercase btn btn-yellow btn-block btn-lg text-light text-md'>Lihat Semua Paket Tour</a>
	</div>
</div>