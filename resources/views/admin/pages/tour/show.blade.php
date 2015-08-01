@section('content_title')
	TOUR
@overwrite

@section('content_sidebar')
	@include('admin.widgets.tour.nav')
	<hr/>
	@include('admin.widgets.tour.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_options' 	=> [
									'data' => [
												'filter_tour_id' => $data->id
											]
		]
	])
@overwrite

@section('content_body')
	@include('admin.widgets.tour.detail', [
		'widget_template' 	=> 'plain',
		'widget_options' 	=> [
									'data'	=> [
										'filter_tour_id'	=> $data->id
									]
		]
	])
@overwrite