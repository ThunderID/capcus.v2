@section('content_title')
	VENDOR
@stop

@section('content_sidebar')
	@include('admin.widgets.vendor.nav')
	<hr/>
	@include('admin.widgets.vendor.filter', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
													'filter_category_type'			=> 'vendor',
													'filter_user_type'				=> 'admin',
												]
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.vendor.data_table', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_category_type'		=> 'vendor',
													'filter_vendor_name'		=> Input::get('filter_vendor_name'),
													'filter_vendor_category'	=> Input::get('filter_vendor_category'),
													'vendor_paginate'			=> 25,
													'vendor_current_page'		=> Input::get('page'),
													'vendor_order'				=> 'latest',
												]
								]
			])
@stop