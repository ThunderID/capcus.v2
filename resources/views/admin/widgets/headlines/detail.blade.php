<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['headline'];
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
		{{$widget_title or $headline->title}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>
					<strong>Active Since</strong>
					<br/>{{$headline->active_since->format('d-M-Y [H:i]')}}
				</p>

				<p>
					<strong>Active Until</strong>
					<br/>{{$headline->active_until->format('d-M-Y [H:i]')}}
				</p>

				<p>
					<strong>Travel Agent</strong>
					<br/>{{$headline->travel_agent->name or "-"}}
				</p>

				<p>
					<strong>Small Image</strong>
					<br>{!! Html::image($headline->images->where('name', 'SmallImage')->first()->path, 'Small Image', ['class' => 'img-thumbnail']) !!}
				</p>

				<p>
					<strong>Medium Image</strong>
					<br>{!! Html::image($headline->images->where('name', 'MediumImage')->first()->path, 'Medium Image', ['class' => 'img-thumbnail']) !!}
				</p>

				<p>
					<strong>Large Image</strong>
					<br>{!! Html::image($headline->images->where('name', 'LargeImage')->first()->path, 'Large Image', ['class' => 'img-thumbnail']) !!}
				</p>


			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>
					<strong>Link To</strong>
					<br><iframe src="{{ $headline->link_to }}" width="100%" height="800"></iframe>
				</p>
			</div>
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif