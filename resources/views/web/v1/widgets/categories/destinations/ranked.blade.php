<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Categories: Destinatins: Ranked';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['destinations'];
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
		{{$widget_title or "Ranked Destination"}}
	@overwrite

	@section('widget_body')
		@if ($destinations)
			@foreach ($destinations as $k => $x)
				<div class='pull-left pt-5 pb-5 pr-xs pl-xs bg-dark text-white mr-xs text-md'>{{$k + 1}}</div>
				<div class='pt-5'>
					<a href='{{route("web.tour", ["vendor" => "semua-vendor", "tujuan" => $x->slug])}}' class='text-black text-uppercase text-md'>
						{{$x->name}}
					</a>
				</div>
				<hr class='border-dotted mb-sm mt-sm'>
			@endforeach
		@else
			No data found
		@endif
	@overwrite

	@section('js')
		@parent
		{!! Html::script('plugins/owl.carousel-2/owl-carousel/owl.carousel.min.js') !!}

		<script>
			$('.owl-carousel').owlCarousel({
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				stopOnHover: true,
				scrollPerPage: true,
				pagination:false,

				items : 2,
				itemsDesktop: [1200,2],
				itemsDesktopSmall: [992,2],
				itemsTablet: [768,1]
			});

			$('.carousel > .btn-prev').click(function() {
				$(this).parent().find('.owl-carousel').trigger('owl.prev');
			});

			$('.carousel > .btn-next').click(function() {
				$(this).parent().find('.owl-carousel').trigger('owl.next');
			});

		</script>
	@stop

	@section('css')
		@parent
		{!! Html::style('plugins/owl.carousel-2/owl-carousel/owl.carousel.css') !!}
		{!! Html::style('plugins/owl.carousel-2/owl-carousel/owl.theme.css') !!}
	@stop
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif