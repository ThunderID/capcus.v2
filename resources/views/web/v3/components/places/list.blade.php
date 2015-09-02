<?php
	$required_variables = ['place'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('places.list' . $x . ": Required", 1);
		}
	}
?>
<div class='place-list bg-white'>
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-6 col-lg-4 pr-0">
			<img src="{{$place->images->where('name', 'Gallery1')->first()->path}}" class='image43'>
		</div>
		<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
			<img src="{{$place->images->where('name', 'Gallery1')->first()->path}}" class='image43'>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			<div class='mr-xs ml-xs'>
				<h2 class='text-lg mb-0'>
					<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='title'>{{$place->name}}</a>
				</h2>
				<div class='mt-5'><i class='fa fa-map-marker'></i> {{$place->destination->long_name}}</div>

				<div class='description text-black mt-sm'>
					{{$place->summary}}
				</div>

				<?php
					$total_schedules = 0;
					foreach ($place->upcoming_tours as $tour)
					{
						$total_schedules += $tour->schedules->count();
					}
				?>

				<div class='mt-xl'>
					<div class='hidden-sm hidden-md hidden-lg text-center mb-sm'>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn'>BACA SELENGKAPNYA</a>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn'><i class='fa fa-plane'></i> {{$total_schedules}} Paket tour</a>
					</div>
					<div class='hidden-xs hidden-md hidden-lg text-center mb-sm'>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn btn-block'>BACA SELENGKAPNYA</a>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn btn-block mt-xs'><i class='fa fa-plane'></i> {{$total_schedules}} Paket tour</a>
					</div>
					<div class='hidden-xs hidden-sm text-right'>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn '>BACA SELENGKAPNYA</a>
						<a href="{{ route('web.places.show', ['destination' => $place->destination->path_slug, 'slug' => $place->slug]) }}" class='awe-btn '><i class='fa fa-plane'></i> {{$total_schedules}} Paket tour</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
