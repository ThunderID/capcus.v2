<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['title_field', 'writer_field', 'status_field', 'default_title', 'default_writer', 'default_status', 'writer_list', 'status_list'];
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
				<small>Title</small>
				{!! Form::text($title_field, $default_title, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>By</small>
				<br/>{!! Form::select($writer_field, ['' => 'All'] + $writer_list->toArray(), Input::get($writer_field), ['class' => 'form-control select2']) !!}
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Status</small>
				<br/>{!! Form::select($status_field, 	
									['' => 'All'] + (is_array($status_list) ? $status_list : []), 
									$default_status, ['class' => 'form-control select2']) !!}
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