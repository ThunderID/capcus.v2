@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 	=> "plain",
		'title_field'		=> 'title',
		'writer_field'		=> 'writer',
		'status_field'		=> 'status',
		'default_title'		=> $filters['title'],
		'default_writer'	=> $filters['writer'],
		'default_status'	=> $filters['status'],
		'writer_list'		=> $writer_list,
		'status_list'		=> $status_list,
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'articles'			=> $data,
			'filter_title'		=> $filters['title'],
			'filter_status'		=> $filters['status'],
			'filter_writer'		=> $filters['writer_name'],
	])
@stop