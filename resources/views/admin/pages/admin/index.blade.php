@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 		=> "plain",
		'name_field'			=> 'name',
		'default_name'			=> $filters['name']
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'users'		=> $data,
			'filters'			=> ['name' => $filters['name']]
	])
@stop