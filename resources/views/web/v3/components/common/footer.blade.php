<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.footer: ' . $x . ": Required", 1);
		}
	}
?>

<div class="row">
	<!-- WIDGET -->
	<div class="col-md-3">
		<div class="widget widget_contact_info">
			<div class="widget_background">
				<div class="widget_background__half">
					<div class="bg"></div>
				</div>
				<div class="widget_background__half">
					<div class="bg"></div>
				</div>
			</div>
			<div class="logo">
				{!! Html::image('images/logo/logo-new.png', 'Capcus.id', ['class' => 'hidden-sm hidden-xs']) !!}
				{!! Html::image('images/logo/logo-new-white.png', 'Capcus.id', ['class' => 'hidden-md hidden-lg']) !!}
			</div>
			<div class="widget_content">
				<p>
					THE CEO BUILDING, Lv 12
					<br>Jl. TB Simatupang No. 18C
					<br>Jakarta Selatan 12430, Indonesia
				</p>
				<a href="#">contact[at]capcus.id</a>
			</div>
		</div>
	</div>
	<!-- END / WIDGET -->

	<!-- WIDGET -->
	<div class="col-md-5">
		<div class="widget widget_about_us">
			<h3>Tentang Capcus</h3>
			<div class="widget_content">
				<p>
					CAPCUS menyediakan kemudahan kepada travellers untuk mencari paket tour yang sesuai dengan kebutuhannya. 
					Dengan adanya CAPCUS, travellers tidak lagi perlu menghubungi travel agent untuk mencari paket tour yang 
					sesuai dengan kebutuhannya
				</p>

				<p>
					Lets Travel!
				</p>
				
				<p>
					<a href="{{ route('web.about.tnc') }}">Term &amp; Condition</a>
				</p>
			</div>
		</div>
	</div>
	<!-- END / WIDGET -->

	<!-- WIDGET -->
	<div class="col-md-3">
		<div class="widget widget_follow_us">
			<div class="widget_content">
				@include('web.v3.components.common.subscribe')

				<div class="awe-social">
					<a href="http://twitter.com/capcusid"><i class="fa fa-twitter"></i></a>
					<a href="http://facebook.com/capcusid"><i class="fa fa-facebook"></i></a>
					<a href="http://instagram.com/capcusid"><i class="fa fa-instagram"></i></a>
				</div>
			</div>
		</div>
	</div>
	<!-- END / WIDGET -->
</div>
<div class="copyright">
	<p>©2015 CAPCUS.ID. All rights reserved.</p>
</div>
