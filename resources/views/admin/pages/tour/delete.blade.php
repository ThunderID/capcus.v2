@section('content_title')
	TOUR
@stop

@section('content_sidebar')
	@include('admin.widgets.tour.nav')
	<hr/>
	@include('admin.widgets.tour.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_tour_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.tour.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => ['filter_tour_id'			=> $data->id],
								]
			])
@stop