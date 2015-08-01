@section('content_title')
	ADMIN
@stop

@section('content_sidebar')
	@include('admin.widgets.admin.nav')
	<hr/>
	@include('admin.widgets.admin.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
												'filter_user_id'			=> $data->id,
												'filter_user_type'			=> 'admin'
											  ],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.admin.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_user_id'			=> $data->id,
													'filter_user_type'			=> 'admin'
												  ],
								]
			])
@stop