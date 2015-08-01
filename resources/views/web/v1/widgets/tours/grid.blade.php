<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Tour:Grid';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tours'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "Tour" !!}
	@overwrite

	@section('widget_body')
		@if ($tours->count())
			<div class='row'>
				@foreach ($tours as $k => $tour)
					<?php
						$most_discount_schedule = $tour->schedules->sortByDesc('discount')->first();
						$earliest_schedule = $tour->schedules->sortBy('depart_at')->first();
						$cheapest_schedule = $tour->schedules->sortBy('price')->first();
					?>
					@if ($k % 3 == 0)
						<div class="clearfix hidden-xs hidden-sm hidden-md"></div>
					@endif
					@if ($k % 2 == 0)
						<div class="clearfix hidden-xs hidden-lg"></div>
					@endif
					@if ($k % 1 == 0)
						<div class="clearfix hidden-sm hidden-md hidden-lg"></div>
					@endif

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 tour_grid">
						<div class="panel panel-default">
							<div class="panel-heading pr-0 pb-0 pt-0 pl-0 overflowhidden">
								<div class='relative'>
									{!! Html::image($tour->thumbnail_lg, $tour->name, ['class' => 'fullwidth tour_thumbnail', 'data-src' => $tour->thumbnail_lg]) !!}
									<div class=' discount_label absolute topleft ml-xs pt-xs '>
										<div class='text-primary text-lg'>{{number_format($most_discount_schedule->discount / 1000)}}</div>
										@if ($most_discount_schedule->discount % 1000 == 0)
											<div class='text-primary text-sm'>x {{$most_discount_schedule->currency}} 1.000</div>
										@endif
										<div class='text-white text-sm'>Discount Voucher</div>
									</div>
								</div>
							</div>
							<div class="panel-body text-center relative">
								<h4 class='text-bold'>{{$tour->name}}
									<br/><small>By {{$tour->vendor->name}}</small>
								</h4>

								<p class='price text-primary text-md mt-xs'>
									<span class='text-black text-sm'>mulai dari</span><br>
									{{$cheapest_schedule->currency}} {{number_format($cheapest_schedule->price)}}
								</p>
								<div class='absolute bottomleft text-center col-xs-12 pl-0 pr-0 border-0 border-top-1 border-light border-solid'>
									<div class="row">
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pr-0 border-0 border-right-1 border-light border-solid hover-black">
											<a href='#' data-tour-slug="{{$tour->slug}}" class='btn btn-block btn-hover-text-primary btn-square text-black toggle_love'>
												@if ($tour->loved->contains(Auth::id()))
													<i class="fa fa-heart" style='margin-left:-2px'></i>
												@else
													<i class="fa fa-heart-o" style='margin-left:-2px'></i>
												@endif
											</a>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 pl-0 pr-0  border-0 border-right-1 border-light border-solid hover-black">
											<a href='{{route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug])}}' class='btn btn-block btn-hover-text-primary btn-square text-black'>DETAIL</a>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pl-0 border-light border-solid border-0 hover-black" >
											{{-- <a class='btn btn-block btn-hover-text-primary btn-square text-black' title='share'  data-toggle="modal" href='#share-modal' data-tour-name='{{$tour->name}}' data-vendor-name='{{$tour->vendor->name}}' data-tour-discount="{{ $most_discount_schedule->currency . ' ' . number_format($most_discount_schedule->discount,0,'.',',')}} " data-tour-url='{{route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug])}}'>
												<i class="fa fa-share"></i>
											</a> --}}

											<!-- Single button -->
											<div class="btn-group">
												<button type="button" class="btn bg-white btn-hover-text-primary btn-square text-black dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style='max-width:90%'>
													<i class="fa fa-share"></i>
												</button>
												<ul class="dropdown-menu">
													<li><a href='javascript:;' class='link_to_popup_window' data-href="http://facebook.com/sharer/share?u={{urlencode(route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug]))}}"><i class='fa fa-facebook-square'></i> Facebook</a></li>
													<li><a href='javascript:;' class='link_to_popup_window' data-href="http://twitter.com/intent/tweet?status={{urlencode('Klaim diskon hingga ' . $most_discount_schedule->currency . ' ' . number_format($most_discount_schedule->discount, 0, '.', ',') . ' u/ ' . $tour->name . '(' . $tour->vendor->name . ') di ' . route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug]))}}"><i class='fa fa-twitter-square'></i> Twitter</a></li>
													<li><a href='javascript:;' class='link_to_popup_window' data-href="http://plus.google.com/share?u={{urlencode(route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug]))}}"><i class='fa fa-google-plus-square'></i> GooglePlus</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			@if (method_exists($tours, 'lastPage'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						{!! $tours->render() !!}
					</div>
				</div>
			@endif
		@else
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<i>Tidak ada tour ditemukan untuk pencarian di atas</i>
				</div>
			</div>
		@endif
	@overwrite

	@section('js')
		@parent

		<script>
			
			$('.toggle_love').click(function(event) {
				var obj = $(this);
				$.ajax({
					url: '{{route("api.me.love_tour")}}',
					type: 'GET',
					dataType: 'json',
					data: {tour_slug: obj.data('tour-slug')},
				})
				.done(function(data) {
					if (data.status == 'success')
					{
						if (data.data.love == 0)
						{
							obj.find('i').removeClass('fa-heart').addClass('fa-heart-o');
						}
						else
						{
							obj.find('i').removeClass('fa-heart-o').addClass('fa-heart');
						}
					}
				})
				.fail(function(data) {
					if (data.status == 401)
					{
						show_login_modal();
					}
					else
					{
						alert('Invalid Request');
					}
				});
				event.preventDefault();
			});
		</script>


	@stop
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif