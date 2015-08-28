@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Top Nav"}}
	@overwrite

	@section('widget_body')
		<nav class="hidden-xs navbar navbar-inverse navbar-fixed-top mb-0" role="navigation">
			<a class="navbar-brand text-center text-white" href="{{route('admin.dashboard')}}">CAPCUS</a>
			<ul class="nav navbar-nav">
			</ul>
		</nav>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif