@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "MENU" !!}
	@overwrite

	@section('widget_body')
		<ul>
			<li>
				<a class="" href='javascript:;' ><i class='glyphicon glyphicon-dashboard'></i> Destinations</a>
				<ul>
					<li><a class="{{str_is(route('admin.destinations.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.destinations.index")}}' ><i class='glyphicon glyphicon-dashboard'></i> Destinations</a></li>
					<li><a class="{{str_is(route('admin.places.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.places.index")}}' ><i class='glyphicon glyphicon-dashboard'></i> Places</a></li>
				</ul>
			</li>
			<li><a class="{{str_is(route('admin.articles.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.articles.index")}}' ><i class='glyphicon glyphicon-dashboard'></i> Articles</a></li>
			<li>
				<a class="" href='javascript:;' ><i class='glyphicon glyphicon-dashboard'></i> Tours</a>
				<ul>
					<li><a class="{{str_is(route('admin.travel_agents.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.travel_agents.index")}}'><i class='fa fa-user'></i> Travel Agent</a></li>
					<li><a class="{{str_is(route('admin.tours.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tours.index")}}'><i class='fa fa-user'></i> Tour</a></li>
					<li><a class="{{str_is(route('admin.tour_options.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tour_options.index")}}'><i class='fa fa-user'></i> Tour Options</a></li>
				</ul>
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