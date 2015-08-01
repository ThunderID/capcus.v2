@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		PT TAM &copy; 2015
		<br/>
		<a href='javascript:;'>About Us</a> . 
		<a href='javascript:;'>Contact Us</a>	
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif