@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title !!}
	@overwrite

	@section('widget_body')
		{!! $widget_body !!}
	@overwrite
@else
	@section('widget_title')
		{!! $widget_title !!}
	@overwrite

	@section('widget_body')
	@overwrite
@endif