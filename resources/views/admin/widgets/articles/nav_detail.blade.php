<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['article'];
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
		{{$widget_title or "CURRENT"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.show', ['id' => $article->id])}}" class='text-black'>Detail <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.edit', ['id' => $article->id])}}" class='text-black'>Edit <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.delete_confirmation', ['id' => $article->id])}}" class='text-black'>Delete <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif