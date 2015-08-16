<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.common.nav: ' . $x . ": Required", 1);
		}
	}
?>

<nav class="navbar navbar-default mb-0" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('web.home') }}">{!! Html::image('images/logo-black.png', 'CAPCUS.id', ['height' => '45']) !!}</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="text-bold text-uppercase "><a href="{{route('web.home')}}">Home</a></li>
				<li class="text-bold text-uppercase "><a href="{{route('web.tour')}}">Paket Tour</a></li>
				<li class="text-bold text-uppercase "><a href="{{route('web.home')}}">Tujuan Wisata</a></li>
				<li class="text-bold text-uppercase "><a href="{{route('web.home')}}">Blog</a></li>
			</ul>

			<form class="navbar-form navbar-right pt-xs pb-0 mt-0 mb-0" role="search">
					<a href='http://facebook.com/capcudid' class='text-xl'><i class='fa fa-facebook-official'></i></a>
					<a href='http://twitter.com/capcudid' class='text-xl'><i class='fa fa-twitter-square'></i></a>
					<a href='http://instagram.com/capcudid' class='text-xl'><i class='fa fa-instagram'></i></a>
			</form>
			<div class='navbar-form navbar-right'>
				<div class='pt-xs'>Find Us on </div>
			</div>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

