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
				<div class="col-md-12">
					{{-- TOUR NAME --}}
					<h2 class='text-center'>
						{{ $tour_schedule->tour->name }}
					</h2>
					<div class='text-center text-lg text-uppercase text-black'>
						@if (is_null($tour_schedule->departure_until))
							{{ $tour_schedule->departure->format('d-m-Y')}}
						@else
							Kapanpun antara {{ $tour_schedule->departure->format('d-m-Y')}} s/d {{ $tour_schedule->departure_until->format('d-m-Y')}}
						@endif
					</div>

					<hr class='border-0 border-bottom-1 border-black border-solid'>
				</div>


				<div class="col-xs-12 col-sm-3 col-md-2 col-lg-3 text-black pb-lg">
					<div class='hidden-xs'>
						<img src='{{ $tour_schedule->tour->travel_agent->images->where('name', 'SmallLogo')->first()->path}}' class='img-responsive mb-md' alt='{{$tour_schedule->tour->travel_agent->name }}'> 
						<strong class='text-uppercase text-lg'>{{ $tour_schedule->tour->travel_agent->name}}</strong>
						<p>{{ $tour_schedule->tour->travel_agent->addresses}}
					</div>

					<div class='hidden-sm hidden-md hidden-lg'>
						<h6 class='text-regular text-bold text-uppercase text-yellow'>Oleh</h6>
						<img src='{{ $tour_schedule->tour->travel_agent->images->where('name', 'SmallLogo')->first()->path}}' alt='{{$tour_schedule->tour->travel_agent->name }}' class='pull-right' style='width:100px'> 
						<strong class='text-uppercase'>{{ $tour_schedule->tour->travel_agent->name}}</strong>
						<p>{{ $tour_schedule->tour->travel_agent->addresses}}
					</div>
				</div>

				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-9 text-black">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7  pb-lg">
							<h6 class='text-regular text-bold text-uppercase text-yellow'>Ittinary</h6>
							{!! $tour_schedule->tour->ittinary !!}
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<p class='text-xl text-black'>
								{{ $tour_schedule->currency }} {{ number_format($tour_schedule->discounted_price ,0,',','.') }}
								@if ($tour_schedule->discounted_price < $tour_schedule->original_price)
									<br>
									<span class='text-strikethrough text-primary'>
										<span class='text-light text-gray'>{{ $tour_schedule->currency . ' ' . number_format($tour_schedule->original_price, 0, ',','.')}}</span>
									</span>
								@endif
							</p>

							{{-- JADWAL LAINNYA --}}
							@if ($tour_schedule->tour->schedules->count() > 1)
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
										@foreach ($tour_schedule->tour->schedules as $other_schedule)
											@if ($other_schedule->id !=  $tour_schedule->id)
												<tr class='text-regular {{ $other_schedule->departure->lt(\Carbon\Carbon::now()) ? "text-muted":"" }}' data-link="{{route('web.tour.show', ['travel_agent' => $other_schedule->tour->travel_agent->slug, 'tour_slug' => $other_schedule->tour->slug, 'schedule' => $other_schedule->departure->format('Ymd')])}}">
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
					</div>
				</div>

			</div>
		</div>
	</section>

	{{-- OTHER TOURS --}}
	<section>
		<div class="container">
			@if (!Auth::user())
				<div class='cover-login text-center' style='position:absolute; top:0; bottom:0; left:0; right:0; background:rgba(255,255,255,0.0); z-index:100000'>
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
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour_schedule->tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
					        </div>
					        <div role="tabpanel" class="tab-pane pt-lg" id="same-date">
					        	@include('web.v3.components.tour_schedules.table', ['tour_schedules' => $other_tours['by_departure']])
								<p class='text-right'>
									<a class='btn btn-yellow btn-block text-uppercase' href="{{ route('web.tour', ['travel_agent' => 'semua-travel-agent', 'tujuan' => $tour_schedule->tour->destinations->first()->path_slug])}}">Lihat Lebih Lengkapnya</a>
								</p>
					        </div>
					        <div role="tabpanel" class="tab-pane pt-lg" id="same-price">
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
		$('.tour_schedule_table tbody').on('click', 'tr', function(event) {
			window.location = $(this).data('link');
		});
			
	</script>
@stop
