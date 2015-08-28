<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['main_logo'];
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
		<a href="{{$main_logo['link_url'] or ""}}">
			<img src="{{asset('images/'.$main_logo['result']['file_url'])}}" alt="{{$main_logo['img_alt']}}" class='{{$main_logo['img_class'] or ""}}'>
		</a>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif