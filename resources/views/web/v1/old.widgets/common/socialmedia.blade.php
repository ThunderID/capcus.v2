<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['urls'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			$widget_errors->add($x, '$'.$x.': has not been handled');
			$widget_error_count++;
		}
	}
?>

@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		@if ($urls["result"]["facebook_url"])
			<a href='{{$urls["result"]["facebook_url"]}}' class='text-xxl' target="_blank">
				<i class='fa fa-facebook-square'></i>
			</a>
		@endif
		@if ($urls["result"]["twitter_url"])
			<a href='{{$urls["result"]["twitter_url"]}}' class='text-xxl' target="_blank">
				<i class='fa fa-twitter-square'></i>
			</a>
		@endif
		@if ($urls["result"]["instagram_url"])
			<a href='{{$urls["result"]["instagram_url"]}}' class='text-xxl' target="_blank">
				<i class='fa fa-instagram'></i>
			</a>
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif