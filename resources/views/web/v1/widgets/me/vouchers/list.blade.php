<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Me:Voucher:List';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['vouchers'];
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
		{{$widget_title or "My Voucher"}}
	@overwrite

	@section('widget_body')
		@if ($vouchers)
			<div class='row'>
				@foreach ($vouchers as $k => $voucher)
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
										<small>VENDOR</small>
										<br><strong class='text-uppercase'>{{$voucher->schedule->tour->vendor->name}}</strong>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
										<small>TOUR</small>
										<br><strong class='text-uppercase'>{{$voucher->schedule->tour->name}}</strong>
									</div>
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<a href='' class='btn mt-5'>Download Voucher</a>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8  border-0 border-right-1 border-solid border-dotted border-light" style='height:100%'>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 mb-sm">
												<small>TOUR DETAIL</small>
												<br><strong class='text-uppercase'>{{$voucher->schedule->tour->name}}</strong>
												<br><strong class='text-uppercase'>
													{{$voucher->schedule->depart_at->format('M d, Y')}} -
													{{$voucher->schedule->return_at->format('M d, Y')}}</strong>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mb-sm">
												<small>PRICE</small>
												<br><strong class='text-uppercase'>{{$voucher->schedule->currency}} {{number_format($voucher->schedule->price,0,'.',',')}}</strong>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 mb-sm">
												<small>VOUCHER CODE</small>
												<br><strong class='text-uppercase'>{{$voucher->discount_code}}</strong>
											</div>


											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mb-sm">
												<small>DISCOUNT</small>
												<br><strong class='text-uppercase'>{{$voucher->discount_currency}} {{number_format($voucher->discount)}}</strong>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-md">
												<i class='text-sm'>* Kode voucher hanya dapat digunakan pada tour yang tertera di atas dan tidak dapat diuangkan. </i>
												<br/><i class='text-sm'>* Pemesanan tour tersebut dapat dilakukan secara langsung ke vendor yang disebutkan di atas</i>
											</div>

										</div>
									</div>
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mb-sm">
												<small>PASSENGER</small>
												<br><strong class='text-uppercase'>{{$voucher->user->name}}</strong>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-sm">
												<small>VENDOR</small>
												<br>
												<strong class='text-uppercase'>{{$voucher->schedule->tour->vendor->name}}</strong> 
												<p class='text-regular'>
													{{$voucher->schedule->tour->vendor->address}}
												<br><i class='fa fa-phone mr-xs'></i> {{$voucher->schedule->tour->vendor->phone}}
												<br><i class='fa fa-envelope mr-xs'></i> {{$voucher->schedule->tour->vendor->email}}
												</p>
											</div>

												

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			@if (method_exists($vouchers, 'lastPage'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						{!! $vouchers->render() !!}
					</div>
				</div>
			@endif
		@else
			No 
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