<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Dashboard:Nav';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Menu"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Overview <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Articles <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Directories <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Members <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Tours <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Travel Agencies <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Writers <i class='fa fa-chevron-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif