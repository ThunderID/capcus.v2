@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.nav_detail', [
				'widget_template' 	=> "plain", 
				'destination'		=> $data,
			])
	@endif
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.delete', [
			'widget_template' 	=> 'plain',
			'destination'		=> $data
			])
@stop