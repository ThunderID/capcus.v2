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
		<li class="">
			<a href="{{ route('web.home')}}">Home</a>
		</li>
		<li class="">
			<a href="{{ route('web.tour')}}">Paket Tour</a>
		</li>
		<li class="">
			<a href="{{ route('web.places')}}">Tujuan Wisata</a>
		</li>
		<li class="">
			<a href="{{ route('web.blog')}}">Blog</a>
		</li>
		<li class="">
			<a href="{{ route('web.home')}}">Are you travel agent?</a>
		</li>
	</ul>
</nav>
