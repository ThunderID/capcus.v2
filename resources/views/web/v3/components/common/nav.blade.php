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
		<li class=" {{ str_is('web.home', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.home')}}" class=''>Home</a>
		</li>
		<li class=" {{ str_is('web.tour', Route::getCurrentRoute()->getName()) || str_is('web.tour.show', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.tour')}}">Paket Tour</a>
		</li>
		<li class=" {{ str_is('web.places', Route::getCurrentRoute()->getName()) || str_is('web.places.show', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.places')}}">Tujuan Wisata</a>
		</li>
		<li class=" {{ str_is('web.blog', Route::getCurrentRoute()->getName()) || str_is('web.blog.show', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.blog')}}">Blog</a>
		</li>

		@if (!auth()->id)
			<li class=" {{ str_is('web.login', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
				<a href="{{ route('web.login')}}">Sign In / Sign Up</a>
			</li>
		@else
			<li class="menu-item-has-children {{ str_is('web.login', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }}">
				<a href="javascript:;">Hi, {{auth()->name}}</a>
				<ul class="sub-menu">
					<li><a href="{{route('web.me.profile.edit')}}">Profil</a></li>
					<li><a href="{{route('web.logout')}}">Logout</a></li>
				</ul>
			</li>
		@endif
		<li class=" {{ str_is('web.about.imvendor', Route::getCurrentRoute()->getName()) ? 'current-menu-parent' : '' }} ">
			<a href="{{ route('web.about.imvendor')}}">Are you travel agent?</a>
		</li>
	</ul>
</nav>
