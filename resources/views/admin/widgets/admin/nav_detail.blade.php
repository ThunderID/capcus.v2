@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "This Admin"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation">
				<a href="{{route('admin.admin.show', ['id' => $UserComposer['widget_data']['data']['user_db']->id])}}" class='text-black'>Detail <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation">
				<a href="{{route('admin.admin.edit', ['id' => $UserComposer['widget_data']['data']['user_db']->id])}}" class='text-black'>Edit <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation">
				<a href="{{route('admin.admin.delete', ['id' => $UserComposer['widget_data']['data']['user_db']->id])}}" class='text-black'>Delete <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif