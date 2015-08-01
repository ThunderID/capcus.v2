@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Advertisement"}}
	@overwrite

	@section('widget_body')
		{!! HTML::image('http://placehold.it/728x90', 'advertisement 728x90', ['width' => '728' , 'height' => '90']) !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif