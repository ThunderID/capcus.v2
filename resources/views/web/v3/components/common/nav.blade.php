<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.nav: ' . $x . ": Required", 1);
		}
	}

?>

<nav class="navigation awe-navigation" data-responsive="1200">
	<ul class="menu-list text-uppercase">
		<li class=" {{ in_array(Route::getCurrentRoute()->getName(), ['web.home']) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.home')}}" class=''>Home</a>
		</li>
		<li class=" {{ in_array(Route::getCurrentRoute()->getName(), ['web.tour', 'web.tour.show', 'web.tour.tag']) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.tour')}}">Paket Tour</a>
		</li>
		<li class=" {{ in_array(Route::getCurrentRoute()->getName(), ['web.places', 'web.places.show']) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.places')}}">Tujuan Wisata</a>
		</li>
		<li class=" {{ in_array(Route::getCurrentRoute()->getName(), ['web.blog', 'web.blog.show']) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.blog')}}">Blog</a>
		</li>

		@if (!Auth::user()->id)
			<li class=" {{ str_is('web.login', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
				<a href="{{ route('web.login')}}">Sign In / Sign Up</a>
			</li>
		@else
			<li class="menu-item-has-children {{ str_is('web.login', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }}">
				<a href="javascript:;">Hi, {{Auth::user()->name}}</a>
				<ul class="sub-menu">
					<li><a href="{{route('web.me.profile.edit')}}">Profil</a></li>
					<li><a href="{{route('web.logout')}}">Logout</a></li>
				</ul>
			</li>
		@endif
		{{-- <li class=" {{ str_is('web.about.imvendor', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.about.imvendor')}}">Are you travel agent?</a>
		</li> --}}
	</ul>
</nav>
