@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "MY MENU" !!}
	@overwrite

	@section('widget_body')
		<ul>
			<li><a href='{{route("admin.dashboard")}}' class=''>My Account</a></li>
			<li><a href='{{route("admin.me.update_password")}}' class=''>Update Password</a></li>
			<li><a href='{{route("admin.logout")}}' class=''>Logout</a></li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif