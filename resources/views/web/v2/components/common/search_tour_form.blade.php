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


{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']) !!}
	<span class='select-simple'>
		{!! Form::select('travel_agent', 
						$travel_agent_list->lists('name', 'slug'),
						$default_filter_travel_agent, 
						['class' => 'width25', 'placeholder' => 'Semua Travel Agent']) 
		!!}
	</span>
	&nbsp;
	
	<span class='select-simple'>
		{!! Form::select('tujuan', 
						$destination_list->lists('path', 'path_slug'),
						$default_filter_tujuan, 
						['class' => 'width25 select2', 'placeholder' => 'Semua Tujuan']) 
		!!}
	</span>
	&nbsp;

	<span class='select-simple'>
		{!! Form::select('keberangkatan', (is_array($departure_list) ? $departure_list : []),
						$default_filter_keberangkatan, 
						['class' => 'width25']) 
		!!}
	</span>
	&nbsp;

	<span class='select-simple'>
		{!! Form::select('budget', 
						$budget_list, 
						$default_filter_budget, 
						['class' => 'width25']) 
		!!}
	</span>

	<div class="clearfix hidden-sm hidden-md hidden-lg"></div>

	<button type='submit' class='btn btn-default pt-xs pb-xs ml-xs' style='margin-top:-4px;'>CARI</button>
{!! Form::close(); !!}