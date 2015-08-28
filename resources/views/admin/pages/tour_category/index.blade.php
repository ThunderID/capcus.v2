@section('content_title')
	DESTINATION
@stop

@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 	=> "plain",
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
									'data' => [
												'filter_category_type'		=> 'tour',
												'filter_category_name'		=> Input::get('filter_category_name'),
									]
								]
			])
@stop