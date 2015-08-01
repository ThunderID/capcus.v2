<?php
	if ($VendorComposer['widget_data']['data']['vendor_db'])
	{
		$VendorComposer['widget_data']['data']['vendor_db']->load('tours', 'tours.schedules');
	}
?>
@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		@if ($VendorComposer['widget_data']['data']['vendor_db'])
			<div class='row'>
				@foreach ($VendorComposer['widget_data']['data']['vendor_db'] as $k => $x)
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
						<div class="panel panel-default ">
							<div class="panel-heading pr-0 pl-0 overflowhidden bg-primary pt-0 pb-0">
								<div class='relative text-center'>
									{!! Html::image($x->logo_sm, $x->name, ['class' => 'img-circle width50 mt-sm mb-sm', 'data-src' => $x->logo_sm]) !!}
								</div>
							</div>
							<div class="panel-body text-center relative">
								<h4 class='text-bold text-uppercase'>{{$x->name}}</h4>
								{{$x->address}}
								<br>{{$x->phone}}
								<br>{!! Html::link($x->website, $x->website, ['target' => '_blank']) !!}

								<div class='absolute bottomleft text-center col-xs-12 pl-0 pr-0 border-0 border-top-1 border-light border-solid'>
									<div class="row">
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pr-0 border-0 border-right-1 border-light border-solid hover-black">
											<a href='{{route("web.tour.show", ["vendor_slug" => $x->vendor->slug, "tour_slug" => $x->slug])}}' class='btn btn-block btn-hover-black btn-square text-black'>
												<i class="fa fa-heart-o" style='margin-left:-2px'></i>
											</a>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 pl-0 pr-0  border-0 border-right-1 border-light border-solid hover-black">
											<?php
											$tours_count = 0;
											foreach ($x->tours as $v)
											{
												$tours_count += $v->schedules->count();
											}
											?>
											<a href='{{route("web.tour", ["vendor" => $x->slug])}}' class='btn btn-block btn-hover-black btn-square text-black'>{{$tours_count}} Jadwal Tour</a>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pl-0 border-light border-solid border-0 hover-black">
											<a href='{{route("web.tour.show", ["vendor_slug" => $x->vendor->slug, "tour_slug" => $x->slug])}}' class='btn btn-block btn-hover-black btn-square text-black' title='share'>
												<i class="fa fa-share"></i>
											</a>
										</div>
									</div>
									{{-- <a href='{{route("web.tour.show", ["vendor_slug" => $x->vendor->slug, "tour_slug" => $x->slug])}}' class='btn btn-default btn-block'>GET {{$most_discount_schedule->currency}} {{number_format($most_discount_schedule->discount)}} VOUCHER</a> --}}
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			@if (method_exists($VendorComposer['widget_data']['data']['vendor_db'], 'lastPage'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						{!! $VendorComposer['widget_data']['data']['vendor_db']->render() !!}
					</div>
				</div>
			@endif
		@else
			Tidak ada vendor ditemukan
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif