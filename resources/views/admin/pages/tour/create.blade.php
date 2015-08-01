@section('content_title')
	TOUR
@overwrite

@section('content_sidebar')
	@include('admin.widgets.tour.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.tour.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_title' 		=> 'THIS TOUR', 
				'widget_options' 	=> [
					'data' => ['filter_tour_id' => $data->id]
				]
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.tour.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
			'data' => [
				'filter_tour_id'		=> ($data->id ? $data->id : 0),
				'filter_category_type'	=> 'tour',
				'vendor_order'			=> 'name'
			]
		]
	])
@overwrite