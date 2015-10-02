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
		<div role="tabpanel" class='bs-tab bs-tab-search-tour'>
			{{-- <!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
						<i class="awe-icon awe-icon-briefcase"></i>
					</a>
				</li>
				<li role="presentation">
					<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">
						<i class="awe-icon awe-icon-marker-1"></i>
					</a>
				</li>
			</ul> --}}
		
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">
					<h4 class='text-lg text-uppercase mt-md'>Cari Paket Tour</h4>
					@include('web.v3.components.search.tour_form')
				</div>
				{{-- <div role="tabpanel" class="tab-pane fade" id="tab">
					<h4 class='text-lg text-uppercase'>Cari Tujuan Wisata</h4>
					@include('web.v3.components.search.place_form')
				</div> --}}
			</div>
		</div>
	</div>
</section>