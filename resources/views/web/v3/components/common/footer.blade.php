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
						{!! Html::image('images/logo-white.png') !!}
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
			<div class="col-md-2">
				<div class="widget widget_about_us">
					<h3>Tentang Capcus</h3>
					<div class="widget_content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel dignissim dolor. Ut risus orci, aliquam sit amet semper eget, egestas aliquam felis.</p>
					</div>
				</div>
			</div>
			<!-- END / WIDGET -->

			<!-- WIDGET -->
			<div class="col-md-2">
				<div class="widget widget_categories">
					<h3>Paket Tour</h3>
					<ul>
						<li><a href="#">Countries</a></li>
						<li><a href="#">Regions</a></li>
						<li><a href="#">Cities</a></li>
						<li><a href="#">Districts</a></li>
						<li><a href="#">Countries</a></li>
						<li><a href="#">Airports</a></li>
						<li><a href="#">Hotels</a></li>
						<li><a href="#">Places of interest</a></li>
					</ul>
				</div>
			</div>
			<!-- END / WIDGET -->

			<!-- WIDGET -->
			<div class="col-md-2">
				<div class="widget widget_recent_entries">
					<h3>Recent Blog</h3>
					<ul>
						<li><a href="#">Countries</a></li>
						<li><a href="#">Regions</a></li>
						<li><a href="#">Cities</a></li>
						<li><a href="#">Districts</a></li>
						<li><a href="#">Countries</a></li>
						<li><a href="#">Airports</a></li>
						<li><a href="#">Hotels</a></li>
						<li><a href="#">Places of interest</a></li>
					</ul>
				</div>
			</div>
			<!-- END / WIDGET -->

			<!-- WIDGET -->
			<div class="col-md-3">
				<div class="widget widget_follow_us">
					<div class="widget_content">
						<p></p>
						<span class="phone">099-099-000</span>
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
