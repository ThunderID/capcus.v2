@section('content_title')
	Destination
@stop

@section('content_sidebar')
	@include('admin.widgets.tour_destination.nav')
	<hr/>
	@include('admin.widgets.tour_destination.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_category_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.tour_destination.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
									'data'	=> ['filter_category_id'			=> $data->id],
									]
			])
@stop