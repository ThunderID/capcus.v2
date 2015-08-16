@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "MENU" !!}
	@overwrite

	@section('widget_body')
		<ul>
			<li>
				<a class=""  href='#nav_destinations' data-toggle='collapse' ><i class='fa fa-globe'></i> Destinations</a>
				<ul class='collapse' id='nav_destinations'>
					<li><a class="{{str_is(route('admin.destinations.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.destinations.index")}}' ><i class='fa fa-globe'></i> Destinations</a></li>
					<li><a class="{{str_is(route('admin.places.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.places.index")}}' ><i class='fa fa-map-marker'></i> Places</a></li>
				</ul>
			</li>
			<li><a class="{{str_is(route('admin.articles.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.articles.index")}}' ><i class='fa fa-newspaper-o'></i> Articles</a></li>
			<li>
				<a class=""  href='#nav_tour' data-toggle='collapse' ><i class='fa fa-dashboard'></i> Tours</a>
				<ul class='collapse' id='nav_tour'>
					<li><a class="{{str_is(route('admin.travel_agents.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.travel_agents.index")}}'><i class='fa fa-building-o'></i> Travel Agent</a></li>
					<li><a class="{{str_is(route('admin.tours.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tours.index")}}'><i class='fa fa-plane'></i> Tour</a></li>
					<li><a class="{{str_is(route('admin.tour_options.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tour_options.index")}}'><i class='fa fa-list'></i> Tour Options</a></li>
				</ul>
			<li>
				<a class="{{str_is(route('admin.members.index'), $active_url) ? 'active' : "" }}" href='#nav_user' data-toggle='collapse' aria-expanded="false" aria-controls="nav_user">
					<i class='fa fa-users'></i> Users
				</a>
				<ul class='collapse' id='nav_user'>
					<li><a class="{{str_is(route('admin.members.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.members.index")}}'><i class='fa fa-user'></i> Member</a></li>
					<li><a class="{{str_is(route('admin.admin.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.admin.index")}}'><i class='fa fa-user-plus'></i> Admin</a></li>
				</ul>
			</li>
			<li>
				<a class="{{str_is(route('admin.members.index'), $active_url) ? 'active' : "" }}" href='#nav_settings' data-toggle='collapse' aria-expanded="false" aria-controls="nav_user"><i class='fa fa-gears'></i> Website</a>
				<ul class='collapse' id='nav_settings'>
					<li><a class="{{str_is(route('admin.settings.home.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.settings.home.index")}}'><i class='fa fa-th'></i> Home</a></li>
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