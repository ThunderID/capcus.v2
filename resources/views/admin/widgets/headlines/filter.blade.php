<?php
	foreach (range(1,12) as $range)
	{
		$months[$range] = $range;
	}

	foreach (range(date('Y', strtotime('+1 year')), date('Y', strtotime('20 year ago'))) as $range)
	{
		$years[$range] = $range;
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
				{!! Form::select('filter_headline_month', $months, Input::get('filter_headline_month') ? Input::get('filter_headline_month') : date('m') , ['class' => 'form-control select2']) !!}
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Year</small>
				{!! Form::select('filter_headline_year', $years, (Input::get('filter_headline_year') ? Input::get('filter_headline_year') : date('Y')), ['class' => 'form-control select2']) !!}
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