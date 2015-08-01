<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Vendor:Supported By';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['vendors'];
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
		{{$widget_title or "Supported By"}}
	@overwrite

	@section('widget_body')
		<div class="row">
			@forelse ($vendors as $k => $x)
				@if ($k % 3 == 0)
					<div class="clearfix hidden-xs hidden-sm"></div>
				@endif
				@if ($k % 6 == 0)
					<div class="clearfix hidden-md hidden-lg"></div>
				@endif
				<div class="col-xs-2 col-sm-2 col-md-4 col-lg-4 text-center">
					<a href='{{route("web.tour", ["vendor" => $x->slug])}}' class='text-black '>
						<img src='{{$x->logo_sm}}' data-src='{{$x->logo_sm}}' class='img-responsive desaturate'>
					</a>
				</div>
			@empty
				No data found
			@endforelse
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif
