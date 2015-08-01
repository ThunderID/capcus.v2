@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Menu"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class='{{ str_is("overview", $current_mode) ? "bg-light-blue" : "" }}'>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Overview <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Tours <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Vendors <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Articles <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
				<a href="{{route('admin.' .$route_name)}}" class='text-black'>Users <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif