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

{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']); !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">	
			<div class="pt-lg">
				<label>Tujuan</label>
				{!! Form::select('tujuan', ['semua-tujuan' => "Semua Tujuan"] + $destination_list->lists('long_name', 'path_slug')->toArray(), $default_filter_tujuan, ['class' => 'selectize', 'style' => 'width:100%', 'aria-autocomplete' => "list", 'aria-haspopup' => "true", 'aria-expanded' => "false"])!!}
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">	
			<div class="form-elements">
				<label>Keberangkatan</label>
				<div class="form-item">
					<i class="awe-icon awe-icon-calendar"></i>
					<input type="text" class="awe-calendar" value="Tgl Keberangkatan">
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">	
			<div class="pt-lg">
				<label>Budget</label>
				{!! Form::select('budget', $budget_list, $default_filter_budget ? $default_filter_budget : '', ['class' => 'selectize', 'style' => 'width:100%']) !!}
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">	
			<div class="pt-lg">
				<label>Travel Agent</label>
				{!! Form::select('travel_agent', ['semua-travel-agent' => "Semua"] + $travel_agent_list->lists('name', 'slug')->toArray(), $default_filter_travel_agent, ['class' => 'selectize']) !!}
			</div>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<p class='mt-5'>&nbsp;</p>
			<p class='mt-lg'><button class='btn btn-yellow btn-lg' style='padding:8px 10px !important'>CARI TOUR</button></p>
		</div>
	</div>
</form>

@section('js')
	@parent

	{!! HTML::script('plugins/selectize/js/standalone/selectize.min.js') !!}
	{!! HTML::style('plugins/selectize/css/selectize.css') !!}
	<script>
		$('.selectize').selectize({});
	</script>
@stop