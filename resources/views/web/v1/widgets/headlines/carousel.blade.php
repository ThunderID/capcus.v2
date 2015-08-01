<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Carousel';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['carousel_items'];
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
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		@if ($carousel_items)
			<div class='carousel heightauto'>
				<div class='owl-carousel'>
					@foreach ($carousel_items as $k => $v)
						<div class='item'>
							<a href="{{$v->link_to}}">
								<div class='overlay'></div>
								<img data-src="{{$v->image_lg}}" alt="{{$v->title}}" src="{{$v->image_lg}}">
							</a>
						</div>
					@endforeach
				</div>
				<a href='javascript:;' class='btn-prev btn btn-circle btn-default btn-lg'><i class='fa fa-chevron-left'></i></a>
				<a href='javascript:;' class='btn-next btn btn-circle btn-default btn-lg'><i class='fa fa-chevron-right'></i></a>
			</div>
		@endif
	@overwrite

	@section('js')
		@parent
		{!! HTML::script('plugins/owl.carousel-2/owl-carousel/owl.carousel.min.js') !!}

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
				$(this).siblings('.owl-carousel').trigger('owl.prev');
			});

			$('.carousel > .btn-next').click(function() {
				$(this).siblings('.owl-carousel').trigger('owl.next');
			});

		</script>
	@stop

	@section('css')
		@parent
		{!! HTML::style('plugins/owl.carousel-2/owl-carousel/owl.carousel.css') !!}
		{!! HTML::style('plugins/owl.carousel-2/owl-carousel/owl.theme.css') !!}
	@stop
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif