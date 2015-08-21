<?php
	$required_variables = ['travel_agent_list', 'destination_list', 'departure_list', 'budget_list', 'default_filter_travel_agent', 'default_filter_tujuan', 'default_filter_keberangkatan', 'default_filter_budget'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.common.search_tour: ' . $x . ": Required", 1);
		}
	}
?>

<section>
	<div class="container">
		<div class="awe-search-tabs tabs">
			<ul>
				<li>
					<a href="#awe-search-tabs-1">
						<i class="awe-icon awe-icon-briefcase"></i>
					</a>
				</li>
				<li>
					<a href="#awe-search-tabs-2">
						<i class="awe-icon awe-icon-marker-1"></i>
					</a>
				</li>
			</ul>
			<div class="awe-search-tabs__content tabs__content">
				<div id="awe-search-tabs-1" class="">
					<h2>Cari Paket Tour</h2>
					@include('web.v3.components.search.tour_form')
				</div>
				<div id="awe-search-tabs-2" class="">
					<h2>Cari Tujuan Wisata</h2>
					@include('web.v3.components.search.place_form')
				</div>
			</div>
		</div>
	</div>
</section>