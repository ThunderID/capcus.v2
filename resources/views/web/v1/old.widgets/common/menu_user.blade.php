@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		@if (Auth::user())
			<ul class='mb-lg ml-0 pl-0'>
				<li class='pl-xs mb-5'>
					Hi, {{Auth::user()->name}}
				</li>
				<li>
					<a class="{{str_is('web.me.index', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.me.index")}}' >
						Voucher Tour 
					</a>
				</li>
				<li>
					<a class="{{str_is('web.me.profile.edit', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.me.profile.edit")}}' >
						Edit Profil
					</a>
				</li>
				<li>
					<a class="{{str_is('web.logout', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.logout")}}' >
						Logout
					</a>
				</li>
			</ul>
		@else
			<div class='text-center mb-xs'>
				<a href="{{route('web.login')}}" class='inline'>Daftar / Login</a>
			</div>
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif