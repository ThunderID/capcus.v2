@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title}}
	@overwrite

	@section('widget_body')
		{!! HTML::image('http://placehold.it/250x250', 'advertisement 250x250', ['width' => '250' , 'height' => '250']) !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif