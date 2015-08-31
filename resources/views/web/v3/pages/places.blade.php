@section('content_1')
	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						<li><span>Tujuan Wisata</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class="awe-parallax bg-tujuan-wisata-page" style="background-position: 50% 12px;">
		<div class="container">
			<div class="travelling-block text-center">
				<div class="title">
					<h2>BROWSE TUJUAN WISATA</h2>

					<div role="tabpanel" class='text-center'>
					   <!-- Nav tabs -->
						<ul class="nav nav-pills text-center mt-md" role="tablist">
							<li role="presentation" class="active"><a href="#lokasi" aria-controls="lokasi" role="tab" data-toggle="pill">Lokasi</a></li>
							<li role="presentation"><a href="#kategori" aria-controls="kategori" role="tab" data-toggle="pill">Kategori</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content pt-xxxl">
							<div role="tabpanel" class="tab-pane active" id="lokasi">
								<div class="row ">
									<?php
										$locations = ['asia' => 'asia','afrika' => 'africa', 'amerika' => 'america','eropa' => 'europe','australia' => 'australia', 'antartika' => 'antarctica'];
										asort($locations);
										$i = 0;
									?>
									@foreach ($locations as $k => $v)

										@if ($i++ % 3 == 0)
											<div class="clearfix hidden-md hidden-lg mb-md"></div>
										@endif
										<?php $i++; ?>

										<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
											<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $k])}}" class='text-black text-hover-yellow'>
												<div>
													@if ($v!='america')
														<i class="awe-icon awe-icon-{{$v}} " style='font-size:80px'></i>
													@else
														<i class="awe-icon awe-icon-north-america " style='font-size:40px'></i><br style='mt-0 pt-0 mb-0 pb-0'>
														<i class="awe-icon awe-icon-south-america " style='font-size:40px'></i>
													@endif

													<p class='mt-sm'><span class='text-uppercase'>{{ $k }}</span></p>
												</div>
											</a>
										</div>

									@endforeach
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="kategori">
								<?php
									$kategori = ['kuliner' 		=> 'food',
												 'belanja' 		=> 'bag', 
												 'budaya' 		=> 'culture',
												 'pemandangan'	=> 'nature',
												 'hiburan'		=> 'entertain',
												 'kesehatan'	=> 'briefcase-plus',
												];
									asort($kategori);
								?>
								<div class="row">
									@foreach ($kategori as $k => $v)
										<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 place-icon">
											<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $k])}}">
												<div class='text-center'>
													<i class="awe-icon awe-icon-{{$v}}"></i>
													<p class='mt-xs'><span class='text-uppercase'>{{ $k }}</span></p>
												</div>
											</a>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container mt-xxxl">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" >
				<main>
					<div class="row">
						@forelse ($places as $x)
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<!-- ITEM -->
								<div class="trip-item">
									<div class="item-media">
										<div class="image-cover">
											<img src="{{$x->images->where('name', '=', 'LargeImage')->first()->path}}" style='width:100%'>
										</div>
									</div>
									<div class="item-body">
										<div class="item-title">
											<h2>
												<a href="{{ route('web.places.show', ['destination' => $x->destination->slug, 'slug' => $x->slug]) }}">{{$x->name}}</a>
											</h2>
										</div>
										<div class="item-list">
											{{$x->summary}}
											<p>{{$x->images}}
										</div>
									</div>
									<div class="item-price-more">
										<div class="price">
										</div>
										<a href="{{ route('web.places.show', ['destination' => $x->destination->slug, 'slug' => $x->slug]) }}" class='awe-btn'>DETAIL</a>
									</div>
								</div>
								<!-- END / ITEM -->
							</div>
						@empty
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
								<div class='bg-white-glass pt-lg pb-lg'>Tidak ada tujuan wisata dalam kriteria terpilih</div>
							</div>
						@endforelse
					</div>
				</main>
			</div>
		</div>
	</div>
@stop
