<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	foreach (range(1,12) as $x)
	{
		$month_list[$x] = $x;
	}

	foreach (range(date('Y'), date('Y')+5) as $x)
	{
		$year_list[$x] = $x;
	}

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
		{{$widget_title or 'Filter'}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $widget_data['form_url'], 'method' => 'get', 'class' => 'form']) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Month</small>
				{!! Form::select('filter_headline_month', $month_list, Input::get('filter_headline_month') ? Input::get('filter_headline_month') : date('m') , ['class' => 'form-control select2']) !!}
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Year</small>
				{!! Form::select('filter_headline_year', $year_list, (Input::get('filter_headline_year') ? Input::get('filter_headline_year') : date('Y')), ['class' => 'form-control select2']) !!}
			</div>
			{{-- SEARCH BUTTON --}}
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-sm text-center">
				<button type='submit' class='btn btn-info btn-block'><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</div>
		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif