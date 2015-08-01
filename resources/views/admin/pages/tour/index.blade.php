@section('content_title')
	TOUR
@stop

@section('content_sidebar')
	@include('admin.widgets.tour.nav')
	<hr/>
	@include('admin.widgets.tour.filter', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
													'vendor_order'		=> 'name',
													'filter_tour_name'	=> Input::get('filter_tour_name'),
													'filter_tour_vendor'=> Input::get('filter_tour_vendor')
												]
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.tour.data_table', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_tour_name'			=> Input::get('filter_tour_name'),
													'filter_tour_vendor'		=> Input::get('filter_tour_vendor'),
													'tour_paginate'				=> 25,
													'tour_current_page'			=> Input::get('page'),
													'tour_order'				=> 'latest',
												]
								]
			])
@stop