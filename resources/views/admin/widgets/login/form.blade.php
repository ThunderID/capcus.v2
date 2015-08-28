<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Me:Profile_form';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['form_url', 'id_field'];
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
		{{ $widget_title or "SIGN IN" }}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $form_url, 'method' => 'post']) !!}

		<p>Please enter your credentials below</p>

		<p><input type="{{$id_field}}" name="{{$id_field}}" id="input" class="form-control" value="" required="required" placeholder="{{$id_field}}" autofocus autocomplete="off"></p>
		<p><input type="password" name="password" id="input" class="form-control" required="required" placeholder="password"></p>

		<div class='text-center'>
			<button type='submit' class='btn btn-default'>LOGIN</button>
		</div>

		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif