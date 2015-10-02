@section('content_1')
	<section>
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('web.home') }}">Home</a></li>
					<li><a href="{{ route('web.tour') }}">Paket Tour</a></li>
					<li><a href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour->destinations->first()->path_slug]) }}">{{$tour->destinations->first()->long_name}}</a></li>
					<li><a href="{{ route('web.tour', ['travel_agent' => $tour->travel_agent->slug]) }}">{{$tour->travel_agent->name}}</a></li>
					<li><span>{{ $tour->name}} ({{ $tour_schedule->departure->format('d-M-Y') }})</span></li>
				</ul>
			</div>
		</div>
	</section>	
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<section class="pb-0" style="-webkit-transform: none;">
		<div class="container" style="-webkit-transform: none;">
			<div class="row">
				<div class="col-md-12">
					{{-- TOUR NAME --}}
					<h2 class='text-center'>
						{{ $tour->name }}
					</h2>
					<div class='text-center text-lg text-uppercase text-black'>
						@if (is_null($tour_schedule->departure_until))
							{{ $tour_schedule->departure->format('d-m-Y')}}
						@else
							Kapanpun antara {{ $tour_schedule->departure->format('d-m-Y')}} s/d {{ $tour_schedule->departure_until->format('d-m-Y')}}
							@if ($tour_schedule->min_person)
								(min {{ $tour_schedule->min_person}} pax)
							@endif
						@endif
					</div>

					<hr class='border-0 border-bottom-1 border-black border-solid'>
				</div>


				<div class="col-xs-12 col-sm-3 col-md-2 col-lg-3 text-black pb-lg">
					<div class='hidden-xs'>
						<img src='{{ $tour->travel_agent->images->where('name', 'SmallLogo')->first()->path}}' class='img-responsive mb-md' alt='{{$tour->travel_agent->name }}'> 
						
						{{-- <strong class='text-uppercase text-lg'>{{ $tour->travel_agent->name}}</strong> --}}
						{!! nl2br($tour->travel_agent->address) !!}

						<div class="clearfix"></div>

						<div class='mt-xxl text-black'>
							<a href='tel:{{str_replace('-', '', $tour->travel_agent->phone)}}'>
								<div class='text-xxxl pull-left mr-sm'>
									<i class='fa fa-phone border-1 border-solid border-gray border-circle text-yellow bg-hover-yellow text-hover-black' style='padding:8px 11px'></i>
								</div>
								<span class='text-black'>Untuk Reservasi Hub./Klik:</span>
								<br><strong class='text-lg text-black'>{{$tour->travel_agent->phone}}</strong>
							</a>
						</div>
					</div>

					<div class='hidden-sm hidden-md hidden-lg'>
						<h6 class='text-regular text-bold text-uppercase text-yellow'>Oleh</h6>
						<img src='{{ $tour->travel_agent->images->where('name', 'SmallLogo')->first()->path}}' alt='{{$tour->travel_agent->name }}' class='pull-right' style='width:100px'> 
						<strong class='text-uppercase'>{{ $tour->travel_agent->name}}</strong>
						<br>{!! nl2br($tour->travel_agent->address) !!}
						
						<div class="clearfix"></div>

						<div class='mt-sm text-black mb-lg'>
							<div class='text-xxxl pull-left mr-sm'>
								<i class='fa fa-phone border-1 border-solid border-gray border-circle text-yellow' style='padding:8px 11px'></i>
							</div>
							Untuk Reservasi Hub:
							<br><strong class='text-lg text-black'>{{$tour->travel_agent->phone}}</strong>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-9 text-black">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-lg">
							<section>
								{{-- <div id="slider-revolution">
									<ul>
										@foreach ($tour->places as $k => $x)
											@if ($k <= 5)
												<li data-slotamount="" data-masterspeed="500" data-title="{{ $x->name }}" data-link="#" data-link-to="{{ route('web.places.show', ['destination' => $x->destination->path_slug, 'slug' => $x->slug]) }}" style='cursor:pointer'>
													<img src="{{ $x->images->where('name', 'Gallery1')->first()->path }}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="{{ $x->name }}">

													<div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-1" data-x="30" data-y="bottom" data-speed="400" data-start="1500" data-easing="easeOutBack">
														<div class='pb-xl'>{{ $x->name }}</div>
													</div>
												</li> 
											@endif
										@endforeach
									</ul>
								</div> --}}

								<div id="place-carousel" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										@foreach ($tour->places as $k => $x)
											@if ($k <= 5)
												<li data-target="#place-carousel" data-slide-to="{{$k}}" class="{{ $k == 0 ? 'active' : ''}}"></li>
											@endif
										@endforeach
									</ol>
									<div class="carousel-inner">
										@foreach ($tour->places as $k => $x)
											@if ($k <= 5)
												<div class="item {{ $k == 0 ? 'active' : ''}}">
													<img class='fullwidth' src='{{ $x->images->where('name', 'Gallery1')->first()->path }}'>
													<div class="container">
														<div class="carousel-caption">
															<h1 class='text-white'>{{ $x->name }}</h1>
															{{-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> --}}
														</div>
													</div>
												</div>
											@endif
										@endforeach
									</div>
									<a class="left carousel-control" href="#place-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
									<a class="right carousel-control" href="#place-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
							</section>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 pb-lg">
							<h6 class='text-regular text-bold text-uppercase text-yellow'>Ittinary</h6>
							{{-- ITTINARY --}}
							{!! $tour->ittinary !!}

							<p class='mt-md mb-md'>
								<a href="javascript:;" data-id='{{$tour_schedule->id}}' class='awe-btn {{ in_array( $tour_schedule->id, Session::get('compare_cart')) ? '': 'awe-btn-style2'}} compare_tour add'>
									<i class='fa fa-check {{ in_array( $tour_schedule->id, Session::get('compare_cart')) ? '': 'hidden'}}'></i> Bandingkan
								</a>
							</p>

							{{-- TUJUAN WISATA --}}
							{{-- <h6 class='text-regular text-bold text-uppercase text-yellow'>Tujuan Wisata</h6>
							@foreach ($tour->places as $k => $place)
								@if ($k)
									, 
								@endif
								<a href='{{ route("web.places.show", ["destination" => $place->destination->slug, 'slug' => $place->slug])}}' class='text-black text-hover-yellow'>{{$place->name}}</a>
							@endforeach --}}

						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<p class='text-xl text-black mt-lg'>
								{{ $tour_schedule->currency }} {{ number_format($tour_schedule->discounted_price ,0,',','.') }}
								@if ($tour_schedule->discounted_price < $tour_schedule->original_price)
									<br>
									<span class='text-strikethrough text-primary'>
										<span class='text-light text-gray'>{{ $tour_schedule->currency . ' ' . number_format($tour_schedule->original_price, 0, ',','.')}}</span>
									</span>
								@endif
							</p>

							{{-- OPTIONS --}}
							@include('web.v3.components.tour_options.table_for_tour_schedule')

							{{-- JADWAL LAINNYA --}}
							@if ($tour->schedules->count() > 1)
								<h6 class='text-regular text-bold text-uppercase mt-xl text-yellow'>Jadwal Keberangkatan Lainnya</h6>
								<table class='table table-hover tour_schedule_table'>
									<thead>
										<tr>
											<th class="">TGL</th>
											<th align='right' class='text-right'>HARGA</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($tour->schedules as $other_schedule)
											@if ($other_schedule->id !=  $tour_schedule->id)
												<tr class='text-regular {{ $other_schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"" }}' data-link="{{route('web.tour.show', ['travel_agent' => $tour->travel_agent->slug, 'tour_slug' => $tour->slug, 'schedule' => $other_schedule->departure->format('Ymd')])}}">
													<td class="ticket-price">
														@if (is_null($other_schedule->departure_until))
															{{ $other_schedule->departure->format('d-m-Y')}}
														@else
															Kapanpun antara
															<br>{{ $other_schedule->departure->format('d-m-Y')}} s/d {{ $other_schedule->departure_until->format('d-m-Y')}}
														@endif
													</td>
													<td align='right'>
														{{ $other_schedule->currency }} {{ number_format($other_schedule->discounted_price ,0,',','.') }}
														@if ($other_schedule->original_price != $other_schedule->discounted_price)
															<br>
															<span class='text-strikethrough text-primary'>
																<span class='text-light text-gray'>
																	{{ $other_schedule->currency }} {{ number_format($other_schedule->original_price ,0,',','.') }}
																</span>
															</span>
														@endif
														<p>
														@if ($other_schedule->original_price > $other_schedule->discounted_price)
															<span class="label label-warning">Promo</span>
														@endif
														@if ($other_schedule->id == $tour->cheapest->id)
															<span class="label label-success">Termurah!</span>
														@endif
														</p>
													</td>
													<td>
														<a href="{{route('web.tour.show', ['travel_agent' => $tour->travel_agent->slug, 'tour_slug' => $tour->slug, 'schedule' => $other_schedule->departure->format('Ymd')])}}" class=''>Detail</a>
													</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	{{-- OTHER TOURS --}}
	<section>
		<div class="container">
			<hr class='border-0 border-bottom-1 border-black border-solid'>
			
			@if (!Auth::user())
				<div class='cover-login text-center' style='position:absolute; top:0; bottom:0; left:0; right:0; background:rgba(255,255,255,0.0); z-index:100'>
					<h3 class='text-light pt-xxxl mt-xxxl mr-sm ml-sm'>
						Bantu kami untuk <br>mencarikan paket tour sesuai kebutuhan anda
					</h3>
					<a href='{{route("web.login") . "?redirect=" .Request::url()}}' class='btn btn-yellow' style='width:20%; left:40%'>Login</a>
				</div>
			@elseif (!Auth::user()->is_complete)
				<div class='cover-login text-center' style='position:absolute; top:0; bottom:0; left:0; right:0; background:rgba(255,255,255,0.0); z-index:100000'>
					<h3 class='text-light pt-xxxl mt-xxxl mr-sm ml-sm'>
						Silahkan lengkapi profil anda sebelum dapat mengakses informasi perbandingan tour berikut (hanya butuh 30 detik untuk melengkapinya)
					</h3>
					<a href='{{route("web.me.profile.complete") . "?redirect=" .Request::url()}}' class='btn btn-yellow' style='width:20%; left:40%'>Lengkapi Profil</a>
				</div>
			@endif
			<div class="row {{ !Auth::user()->is_complete ? 'blur-me' : ''}}" style="-webkit-transform: none;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h3 class='text-light'>PAKET TOUR LAINNYA</h3>
					<div role="tabpanel" class="bs-tab-yellow-border">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#same-destination" aria-controls="same-destination" role="tab" data-toggle="tab">Tujuan <span class='hidden-xs'>yg sama</span></a>
							</li>
							<li role="presentation">
								<a href="#same-date" aria-controls="same-date" role="tab" data-toggle="tab"><span class='hidden-xs'>Keberangkatan </span>±{{ $tour_schedule->departure->format('d-M-Y')}}</a>
							</li>
							<li role="presentation">
								<a href="#same-price" aria-controls="same-price" role="tab" data-toggle="tab"><span class='hidden-xs'>Harga </span>±{{ $tour_schedule->currency}} {{ number_format($tour_schedule->discounted_price,0,',','.')}}</a>
							</li>
						</ul>
					
						<!-- Tab panes -->
						<div class="tab-content ">
							<div role="tabpanel" class="tab-pane pt-lg active" id="same-destination">
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_destination']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
							</div>
							<div role="tabpanel" class="tab-pane pt-lg" id="same-date">
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_departure']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
							</div>
							<div role="tabpanel" class="tab-pane pt-lg" id="same-price">
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_budget']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('js')
	@parent
	<script>
		$('.tour_schedule_table tbody').on('click', 'tr', function(event) {
			window.location = $(this).data('link');
		});
			
	</script>
@stop
