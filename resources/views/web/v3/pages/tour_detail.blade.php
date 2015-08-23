@section('content_1')
	<section>
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('web.home') }}">Home</a></li>
					<li><a href="{{ route('web.tour') }}">Paket Tour</a></li>
					<li><a href="{{ route('web.tour', ['travel_agent' => $tour_schedule->tour->vendor->name]) }}">{{$tour_schedule->tour->travel_agent->name}}</a></li>
					<li><a href="{{ route('web.tour', ['travel_agent' => $tour_schedule->tour->vendor->name]) }}">{{$tour_schedule->departure->format('M Y')}}</a></li>
					<li><span>{{ $tour_schedule->tour->name}} ({{ $tour_schedule->departure->format('d-M-Y') }})</span></li>
				</ul>
			</div>
		</div>
	</section>	
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<section class="product-detail pb-0" style="-webkit-transform: none;">
		<div class="container" style="-webkit-transform: none;">
			<div class="row">
				<div class="col-md-6">
					<div class="product-detail__info">
						{{-- TOUR NAME --}}
						<div class="product-title">
							<h2>{{ $tour_schedule->tour->name }}</h2>
						</div>

						<div class="product-tabs tabs ui-tabs ui-widget ui-widget-content ui-corner-all mt-0">
							<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
								<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="overview" aria-labelledby="ui-id-1" aria-selected="true">
									<a href="#overview" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Overview</a>
								</li>
								<li class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="ittinary" aria-labelledby="ui-id-2" aria-selected="true">
									<a href="#ittinary" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Detail Perjalanan</a>
								</li>
								<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="places" aria-labelledby="ui-id-3" aria-selected="false">
									<a href="#places" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">Tujuan Wisata</a>
								</li>
							</ul>
							<div class="product-tabs__content">
								<div id="overview" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
									{{-- TRAVEL AGENT --}}
									<div class='text-black'>
										<img src='{{ $tour_schedule->tour->travel_agent->images->where('name', 'SmallLogo')->first()->path}}' style='height:50px' class='pull-right mr-sm'> 
										<strong class='text-uppercase'>{{ $tour_schedule->tour->travel_agent->name}}</strong>
										<p>{{ $tour_schedule->tour->travel_agent->addresses}}
									</div>


									{{-- TENTANG TOUR INI --}}
									<div class="trips">
										<div class="item">
											<h6>Keberangkatan</h6>
											<p>
												<i class="awe-icon awe-icon-calendar"></i> 
												@if (is_null($tour_schedule->departure_until))
													{{ $tour_schedule->departure->format('d-m-Y')}}
												@else
													Kapanpun antara
													<br>{{ $tour_schedule->departure->format('d-m-Y')}} s/d {{ $tour_schedule->departure_until->format('d-m-Y')}}
												@endif
											</p>
										</div>
										<div class="item">
											<h6>Hari</h6>
											<p><i class="fa fa-clock-o"></i>{{ $tour_schedule->tour->duration_day }} hari {{ $tour_schedule->tour->duration_night }} malam</p>
										</div>
										<div class="item">
											<h6>Harga</h6>
											<p>
												{{ $tour_schedule->currency }} {{ number_format($tour_schedule->discounted_price ,0,',','.') }}
												@if ($tour_schedule->discounted_price < $tour_schedule->original_price)
													<br>
													<span class='text-strikethrough text-primary'>
														<span class='text-light text-gray'>{{ $tour_schedule->currency . ' ' . number_format($tour_schedule->original_price, 0, ',','.')}}</span>
													</span>
												@endif
											</p>
										</div>
									</div>

									{{-- JADWAL LAINNYA --}}
									@if ($tour_schedule->tour->schedules->count() > 1)
										<h6 class='text-regular text-bold'>Jadwal Keberangkatan Lainnya</h6>
										<table class='table table-hover tour_schedule_table'>
											<thead>
												<tr>
													<th class="">TGL</th>
													<th align='right' class='text-right'>HARGA</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach ($tour_schedule->tour->schedules as $other_schedule)
													@if ($other_schedule->id !=  $tour_schedule->id)
														<tr class='text-regular {{ $other_schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"" }}' data-link="{{route('web.tour.show', ['travel_agent' => $other_schedule->tour->travel_agent->slug, 'tour_slug' => $other_schedule->tour->slug, 'schedule' => $other_schedule->departure->format('Ymd')])}}">
															<td class="ticket-price">{{ $other_schedule->departure->format('d-M-Y')}}</td>
															<td align='right'>
																<span class="amount">
																	@if (is_null($other_schedule->departure_until))
																		{{ $other_schedule->departure->format('d-m-Y')}}
																	@else
																		Kapanpun antara
																		<br>{{ $other_schedule->departure->format('d-m-Y')}} s/d {{ $other_schedule->departure_until->format('d-m-Y')}}
																	@endif

																</span>
																		
																@if ($other_schedule->original_price != $other_schedule->discounted_price)
																	<br>
																	<span class='text-strikethrough text-primary'>
																		<span class='text-light text-gray'>
																			{{ $other_schedule->currency }} {{ number_format($other_schedule->original_price ,0,',','.') }}
																		</span>
																	</span>
																@endif
															</td>
															<td>
																@if ($other_schedule->original_price > $other_schedule->discounted_price)
																	<span class="label label-warning">Promo</span>
																@endif
																@if ($other_schedule->id == $tour_schedule->tour->cheapest->id)
																	<span class="label label-success">Termurah!</span>
																@endif
															</td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									@endif
								</div>
								<div id="ittinary" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
									{!! $tour_schedule->tour->ittinary !!}
								</div>
								<div id="places" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
									{!! $tour_schedule->tour->ittinary !!}
								</div>
							</div>
						</div>

						
					</div>
				</div>

				<div class="col-md-6">
					<div class="product-detail__gallery">
						<div class="product-slider-wrapper">
							<div class="product-slider owl-carousel owl-theme" style="opacity: 1; display: block;">
								<div class="owl-wrapper-outer autoHeight" style="height: 370px;"><div class="owl-wrapper" style="width: 11100px; left: 0px; display: block;"><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/1.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/2.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/3.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/4.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/5.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/6.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/7.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/8.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/9.jpg" alt="">
								</div></div><div class="owl-item" style="width: 555px;"><div class="item">
									<img src="images/img/10.jpg" alt="">
								</div></div></div></div>
								
								
								
							<div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><i class="fa fa-caret-left"></i></div><div class="owl-next"><i class="fa fa-caret-right"></i></div></div></div></div>
							<div class="product-slider-thumb-row">
								<div class="product-slider-thumb owl-carousel owl-theme" style="opacity: 1; display: block;">
									<div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2280px; left: 0px; display: block;"><div class="owl-item synced" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-1.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-2.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-3.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-4.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-5.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-1.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-2.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-3.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-4.jpg" alt="">
									</div></div><div class="owl-item" style="width: 114px;"><div class="item">
										<img src="images/img/demo-thumb-5.jpg" alt="">
									</div></div></div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- OTHER TOURS --}}
	<section>
		<div class="container">
			<div class="row" style="-webkit-transform: none;">
				<div class="col-md-12">
					<h3 class='text-light'>PAKET TOUR LAINNYA</h3>
					<div class="product-tabs tabs ui-tabs ui-widget ui-widget-content ui-corner-all mt-xs">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="same_destination" aria-labelledby="ui-id-1" aria-selected="true">
								<a href="#same_destination" class="ui-tabs-anchor text-light text-uppercase" role="presentation" tabindex="-1" id="ui-id-1">Tujuan Yang Sama</a>
							</li>
							<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="same_departure" aria-labelledby="ui-id-2" aria-selected="false">
								<a href="#same_departure" class="ui-tabs-anchor text-light text-uppercase" role="presentation" tabindex="-1" id="ui-id-2">Keberangkatan sekitar {{ $tour_schedule->departure->format('d-M-Y')}}</a>
							</li>
							<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="same_budget" aria-labelledby="ui-id-2" aria-selected="false">
								<a href="#same_budget" class="ui-tabs-anchor text-light text-uppercase" role="presentation" tabindex="-1" id="ui-id-2">Biaya sekitar {{ $tour_schedule->currency }} {{ number_format($tour_schedule->discounted_price,0,',','.') }}</a>
							</li>
						</ul>
						<div class="product-tabs__content">
							<div id="same_destination" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
								{{-- <h4 class='mb-xs text-md  text-uppercase'>Paket Tour ke {{ $tour_schedule->tour->destinations->first()->long_name }} Lainnya</h4> --}}
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_destination']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour_schedule->tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
							</div>
							<div id="same_departure" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
								{{-- <h4 class='mb-xs text-md  text-uppercase'>Paket Tour dengan keberangkatan sekitar tanggal {{ $tour_schedule->departure->format('d-M-Y') }} Lainnya</h4> --}}
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_departure']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour_schedule->tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
							</div>
							<div id="same_budget" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
								{{-- <h4 class='mb-xs text-md  text-uppercase'>Paket Tour dengan Biaya Sekitar {{ $tour_schedule->currency }} {{ number_format($tour_schedule->discounted_price,0,',','.') }} Lainnya</h4> --}}
								@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_budget']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour_schedule->tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
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
		$('.tour_schedule_table').on('click', 'tr', function(event) {
			window.location = $(this).data('link');
		});
			
	</script>
@stop
