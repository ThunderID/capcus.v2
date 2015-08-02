@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	
	<hr>

	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 				=> "plain",
		'filter_name'					=> $filters['name']
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'filters'			=> $filters,
			'travel_agents'		=> $travel_agents
			])
@stop