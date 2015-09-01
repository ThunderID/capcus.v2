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
										<a href="{{ route('web.places', ['tujuan' => $k])}}" class='{{ str_is(strtolower($destination->path_slug), $k) ? "text-yellow":"text-black"}} text-hover-yellow'>
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
							<div class="row">
								@foreach ($tag_list as $k => $v)
									<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 place-icon">
										<a href="{{ route('web.places', ['tujuan' => 'semua', 'tag' => $k])}}">
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