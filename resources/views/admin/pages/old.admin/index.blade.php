@section('content_title')
	ADMIN
@stop

@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.filter', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
													'filter_user_type'				=> 'admin',
													'user_order'					=> 'name'
												]
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$view_name.'.data_table', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_user_name'			=> Input::get('filter_user_name'),
													'filter_user_type'			=> 'admin',
													'user_paginate'				=> 25,
													'user_current_page'			=> Input::get('page'),
													'user_order'				=> 'latest',
												]
								]
			])
@stop