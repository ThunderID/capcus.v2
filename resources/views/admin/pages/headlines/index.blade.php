@section('content_title')
	HEADLINE
@stop

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@include('admin.widgets.headlines.filter', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => [
													'filter_category_type'			=> 'article',
													'filter_user_type'				=> 'admin',
													'user_order'					=> "name",
												]
								]
	])
@stop

@section('content_body')
	<?php 
		$filter_month = (Input::get('filter_headline_month') >= 1 && Input::get('filter_headline_month') <= 12 ? Input::get('filter_headline_month') : date('m'));
		$filter_year = (Input::get('filter_headline_year') ? Input::get('filter_headline_year') : date('Y'));
	?>
	@include('admin.widgets.headlines.data_calendar', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => [
													'filter_headline_since' 	=> \Carbon\Carbon::createFromDate($filter_year, $filter_month, 1),
													'filter_headline_until' 	=> \Carbon\Carbon::createFromDate($filter_year, $filter_month, 1)->endOfMonth(),
													'headline_order' 			=> 'sort_index'
												]
								]
			])
@stop