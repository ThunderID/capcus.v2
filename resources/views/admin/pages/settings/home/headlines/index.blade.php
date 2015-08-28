@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	
	<hr>

	@include('admin.widgets.'.$view_name.'.headlines.filter', [
		'widget_template' 				=> "plain",
		'filter_destination_path'		=> $filters['path']
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.headlines.data_calendar', [
			'widget_template' 	=> 'plain',
			'filters'			=> $filters,
			'headlines'			=> $data
		])
@stop