@section('content_title')
	TOUR
@stop

@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 		=> "plain",
		'filter_name'			=> $filters['name'],
		'filter_travel_agent'	=> $filters['travel_agent'],
		'travel_agents'			=> $travel_agents
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'tours'				=> $tours,
			'filters'			=> ['name' => $filters['name'], 'travel agent' => $filters['travel_agent_name']]
			])
@stop