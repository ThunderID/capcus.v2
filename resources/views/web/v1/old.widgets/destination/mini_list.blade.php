<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['destinations_db'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			$widget_errors->add($x, '$'.$x.': has not been handled');
			$widget_error_count++;
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// MISC
	// ------------------------------------------------------------------------------------------------------------------------
?>

@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Destinations"}}
	@overwrite

	@section('widget_body')
		@if ($destinations_db['result']['data'])
			@foreach ($destinations_db['result']['data'] as $k => $x)
				<div class='pull-left pt-5 pb-5 pr-xs pl-xs bg-dark text-white mr-xs text-md'>{{$k + 1}}</div>
				<div class='pt-5'>
					<a href='javascript:;' class='text-black text-uppercase text-md'>
						{{$x->name}}
					</a>
				</div>
				<hr class='border-dotted mb-sm mt-sm'>
			@endforeach
		@else
			No data found
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif