<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.common.carousel: ' . $x . ": Required", 1);
		}
	}
?>

@for ($i = 1; $i <= 12; $i++)
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
		<?php $homegrid = $homegrids->where('name', 'homegrid_' . $i)->first(); ?>

		@if ($homegrid)
			{{-- <div class='homegrid_div'>
					@if (str_is('destination', $homegrid->type))
						{{$homegrid->destination_obj}}
						<a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $homegrid->destination_detail->path_slug])}}">
							<img src="{{ $homegrid->image_url }}" class='fullwidth'>
							<div class='caption'>
								{{$homegrid->title}}
								<br>
								<span class='text-regular'>
									{{ $homegrid->destination_detail->tours->count()}} Tours
								</span>
							</div>
						</a>
					@elseif (str_is('script', $homegrid->type))
						<img src="{{ $homegrid->image_url }}" class='fullwidth'>
					@endif

				</a>
			</div> --}}
			<div class="homegrid_div">
				@if ((str_is('destination', $homegrid->type)) || (str_is('featured_destination', $homegrid->type)))
					<a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $homegrid->destination_detail->path_slug])}}">
					
						@if (str_is('featured_destination', $homegrid->type))
							<div class='featured_destination_badge'>
								<img src='{{ asset("images/capcus-choice.png")}}' width='80'>
							</div>
						@endif

						<img data-src="{{ $homegrid->image_url }}" alt="Paket tour ke {{$homegrid->title}}" src="{{ $homegrid->image_url }}" class='destination'>
						<div class="caption">
							<div class='text-lg mt-5'>
								{{$homegrid->title}}
							</div>
						</div>
					</a>
				@elseif (str_is('script', $homegrid->type))
					{!! $homegrid->script !!}
				@endif
			</div>
		@endif
	</div>
@endfor