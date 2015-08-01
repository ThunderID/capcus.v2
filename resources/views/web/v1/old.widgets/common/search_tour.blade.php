<?php


	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['vendor_db', 'tujuan_db', 'budget_list', 'departure_lists'];
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
		{{$widget_title or "Search Tour"}}
	@overwrite

	@section('widget_body')
		
	@overwrite

	
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif