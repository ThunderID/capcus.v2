@section('content_1')
	<?php
		$breadcrumbs['Home'] = route('web.home');
		$breadcrumbs['Tujuan Wisata'] = route('web.places');
		$breadcrumbs[$place->destination->name] = route('web.places', ['tujuan' => $place->destination->path_slug]);
		$breadcrumbs[$place->name] = '';
	?>
	{{-- BREADCRUMB --}}
	@include('web.v3.components.common.breadcrumb', ['links' => $breadcrumbs])

	<section class="bg-place-page" style='height:100%;'>
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="blog-heading-content text-uppercase">
				<h2 class='text-yellow bg-black'>{{ $place->destination->long_name }}</h2>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<section class="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1 class='mt-5 pt-5'>{{ $place->name }}</h1>
				</div>
				<div class='col-md-12'>
					<section class="hero-section">
						<div id="slider-revolution">
							<ul>
								@foreach ($place->images as $x)
									@if (str_is('Gallery*', $x->name))
										<li data-slotamount="" data-masterspeed="500" data-title="{{ $x->title }}" style='cursor:pointer'>
											<img src="{{ $x->path }}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="{{ $x->title }}">
											<div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-1" data-x="30" data-y="bottom" data-speed="400" data-start="1500" data-easing="easeOutBack">
												<div class='pb-xs'>{{ $x->title }}</div>
											</div>
										</li> 
									@endif
								@endforeach
							</ul>
						</div>
					</section>
				</div>
				<div class="col-md-12 text-black mt-xl mb-xl">
					<!-- POST -->
					{!! $place->content !!}
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@if ($tour_schedules->count())
						<h3 class='text-light'>Paket Tour Ke Tujuan Wisata Ini</h3>
						@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $tour_schedules])

						<p><a href='{{ route("web.tour") . "?" . http_build_query(["place" => $place->slug]) }}' class='btn btn-block btn-yellow'>Lihat Semua</a></p>
					@endif
				</div>
			</div>

			<hr>


			@if ($other_places->count())
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Tujuan Wisata di {{$place->destination->long_name}} Lainnya</h3>
						<div class="row">
							@foreach ($other_places as $x)
								<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 mb-lg">
									<div class='destination grid'>
										<a href="{{ route('web.places.show', ['destination' => $x->destination->path_slug, 'slug' => $x->slug]) }}" class="text-md text-black">
											<img src="{{ $x->images->where('name', 'Gallery1')->first()->path}}" alt="{{$x->name}}" class='imagesquare'>
											<div class='label'>{{ $x->name }}</div>
										</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@endif
		</div>
	</section>
@stop