@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Alerts"}}
	@overwrite

	@section('widget_body')
		@if ($errors->count())
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Errors!</strong> Please fix the error below:
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
		@endif

		<?php $alert_type = ['alert_success', 'alert_danger', 'alert_info', 'alert_warning']; ?>

		@foreach ($alert_type as $x)
			@if (Session::has($x))
				<div class="alert {{str_replace('_','-',$x)}}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get($x)}}
				</div>
			@endif
		@endforeach
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif