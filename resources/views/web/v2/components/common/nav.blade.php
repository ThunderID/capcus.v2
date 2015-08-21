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

<nav class="navbar navbar-default mb-0 border-0" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar bg-black"></span>
				<span class="icon-bar bg-black"></span>
				<span class="icon-bar bg-black"></span>
			</button>
			<a class="navbar-brand" href="{{ route('web.home') }}">{!! Html::image('images/logo-black.png', 'CAPCUS.id', ['height' => '45']) !!}</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{route('web.home')}}" class=''>Home</a></li>
				<li><a href="{{route('web.tour')}}" class=''>Paket Tour</a></li>
				<li><a href="{{route('web.places')}}" class=''>Tujuan Wisata</a></li>
				<li><a href="{{route('web.home')}}" class=''>Blog</a></li>
			</ul>

			<form class="navbar-form navbar-right pt-xs pb-0 mt-0 mb-0" role="search">
				<div class='pb-5 inline hidden-sm'>Find Us on </div>
				<div class='clearfix hidden-sm hidden-md hidden-lg'></div>
				<a href='http://facebook.com/capcudid' class='text-xl'><i class='fa fa-facebook-square'></i></a>
				<a href='http://twitter.com/capcudid' class='text-xl'><i class='fa fa-twitter-square'></i></a>
				<a href='http://instagram.com/capcudid' class='text-xl'><i class='fa fa-instagram'></i></a>
			</form>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

