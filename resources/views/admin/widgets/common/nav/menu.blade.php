@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "MENU" !!}
	@overwrite

	@section('widget_body')
		<ul>
			<li><a class="{{str_is(route('admin.blog.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.blog.index")}}' ><i class='glyphicon glyphicon-dashboard'></i> Blog</a></li>
			<li><a class="{{str_is(route('admin.dashboard'), $active_url) ? 'active' : "" }}" href='{{route("admin.dashboard")}}' ><i class='glyphicon glyphicon-dashboard'></i> Destination</a></li>
			<li><a class="{{str_is(route('admin.blog.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.blog.index")}}'><i class='fa fa-file-o'></i> Tours</a></li>
			<li>
				<a class="{{str_is(route('admin.member.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.member.index")}}'>
					<i class='fa fa-users'></i> Users
				</a>
				<ul>
					<li><a class="{{str_is(route('admin.member.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.member.index")}}'><i class='fa fa-user'></i> Member</a></li>
					<li><a class="{{str_is(route('admin.admin.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.admin.index")}}'><i class='fa fa-plane'></i> Admin</a></li>
				</ul>
			</li>
			<li>
				<a class="{{str_is(route('admin.member.index'), $active_url) ? 'active' : "" }}" href='javascript:;'><i class='fa fa-gears'></i> Settings</a>
				<ul>
					<li><a class="{{str_is(route('admin.headlines.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.headlines.index")}}'><i class='fa fa-user'></i> Headlines</a></li>
				</ul>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif