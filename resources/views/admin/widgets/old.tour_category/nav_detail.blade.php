@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "THIS CATEGORY"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.show', ['id' => $CategoryComposer['widget_data']['data']['category_db']->id])}}" class='text-black'>Detail <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.edit', ['id' => $CategoryComposer['widget_data']['data']['category_db']->id])}}" class='text-black'>Edit <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' . $route_name . '.delete_confirmation', ['id' => $CategoryComposer['widget_data']['data']['category_db']->id])}}" class='text-black'>Delete <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif