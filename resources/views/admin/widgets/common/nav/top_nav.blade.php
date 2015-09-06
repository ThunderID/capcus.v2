@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Top Nav"}}
	@overwrite

	@section('widget_body')
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('admin.dashboard')}}">CAPCUS</a>
			</div>
		
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class='dropdown'>
						<a class="dropdown-toggle" data-toggle="dropdown"  href='javascript:;' ><i class='fa fa-globe'></i> Destinations</a>
						<ul class='dropdown-menu'>
							<li><a class="{{str_is(route('admin.destinations.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.destinations.index")}}' ><i class='fa fa-globe'></i> Destinations</a></li>
							<li><a class="{{str_is(route('admin.places.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.places.index")}}' ><i class='fa fa-map-marker'></i> Places</a></li>
						</ul>
					</li>
					<li><a class="{{str_is(route('admin.articles.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.articles.index")}}' ><i class='fa fa-newspaper-o'></i> Articles</a></li>
					<li class='dropdown'>
						<a class="dropdown-toggle" data-toggle="dropdown"  href='javascript:;' ><i class='fa fa-dashboard'></i> Tours</a>
						<ul class='dropdown-menu'>
							<li><a class="{{str_is(route('admin.travel_agents.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.travel_agents.index")}}'><i class='fa fa-building-o'></i> Travel Agent</a></li>
							<li><a class="{{str_is(route('admin.tours.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tours.index")}}'><i class='fa fa-plane'></i> Tour</a></li>
							<li><a class="{{str_is(route('admin.tour_options.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.tour_options.index")}}'><i class='fa fa-list'></i> Tour Options</a></li>
						</ul>
					</li>
					<li class='dropdown'>
						<a class="dropdown-toggle" data-toggle="dropdown" href='javascript:;' aria-expanded="false" aria-controls="nav_user">
							<i class='fa fa-users'></i> Users
						</a>
						<ul class='dropdown-menu'>
							<li><a class="{{str_is(route('admin.members.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.members.index")}}'><i class='fa fa-user'></i> Member</a></li>
							<li><a class="{{str_is(route('admin.admin.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.admin.index")}}'><i class='fa fa-user-plus'></i> Admin</a></li>
						</ul>
					</li>
					<li class='dropdown'>
						<a class="dropdown-toggle" data-toggle="dropdown" href='javascript:;' aria-expanded="false" aria-controls="nav_user"><i class='fa fa-gears'></i> Website</a>
						<ul class='dropdown-menu'>
							<li><a class="{{str_is(route('admin.settings.home.index'), $active_url) ? 'active' : "" }}" href='{{route("admin.settings.home.index")}}'><i class='fa fa-th'></i> Home</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ route('web.home') }}" target="_blank">Open Web</a></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Hi, {{Auth::user()->name}} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('admin.me.update_password')}}">Update Password</a></li>
							<li><a href="{{ route('admin.logout')}}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif


