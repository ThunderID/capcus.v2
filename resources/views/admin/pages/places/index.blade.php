@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	
	<hr>

	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 				=> "plain",
		'filter_place_name'				=> $filters['name'],
		'filter_destination_id'			=> $filters['destination'],
		'destinations'					=> $destinations
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'filters'			=> ['name' => $filters['name'], 'destination' => $filtered_destination->path],
			'destinations'		=> $destinations
			])
@stop