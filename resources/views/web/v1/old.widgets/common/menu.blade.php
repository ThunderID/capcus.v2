@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		<ul>
			<li>
				<a href='{{route("web.home")}}' class='{{ str_is("web.home", Route::currentRouteName()) ? "active" : "" }}'>
					Home
				</a>
			</li>
			<li>
				<a href='{{route("web.tour")}}' class='{{ str_is("web.tour*", Route::currentRouteName()) ? "active" : "" }}'>
					Tour
				</a>
			</li>
			<li>
				<a href='{{route("web.vendor")}}' class='{{ str_is("web.vendor*", Route::currentRouteName()) ? "active" : "" }}'>
					Vendors
				</a>
			</li>
			<li>
				<a href='{{route("web.blog")}}' class='{{ str_is("web.blog*", Route::currentRouteName()) ? "active" : "" }}'>
					Blog
				</a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif