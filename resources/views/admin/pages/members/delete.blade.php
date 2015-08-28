@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain",
		'user'			=> $data
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.delete', [
			'widget_template' 	=> 'plain',
			'user'			=> $data
	])
@stop