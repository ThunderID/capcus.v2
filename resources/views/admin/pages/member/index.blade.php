@section('content_title')
	Member
@stop

@section('content_sidebar')
	@include('admin.widgets.member.nav')
	<hr/>
	@include('admin.widgets.member.filter', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
													'filter_user_type'				=> 'member',
													'user_order'					=> 'name'
												]
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.member.data_table', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_user_name'			=> Input::get('filter_user_name'),
													'filter_user_type'			=> 'member',
													'user_paginate'				=> 25,
													'user_current_page'			=> Input::get('page'),
													'user_order'				=> 'latest',
												]
								]
			])
@stop