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
	@include('admin.widgets.common.plain', [
		'widget_template'	=> 'plain',
		'widget_title' 	=> $data->name . ' by ' . $data->vendor->name,
		'widget_body'	=> ''
	])

	@include('admin.widgets.tour.schedule_form', [
		'widget_template' 	=> 'plain',
		'widget_title' 		=> (!$schedule->id ? 'Add new schedule' : 'Edit Schedule: ' . $schedule->depart_at->format('d/m/Y H:i') . ' - ' . $schedule->return_at->format('d/m/Y H:i')),
		'widget_title_class'=> 'text-light',
		'widget_options' 	=> [
									'data'	=> [
										'filter_tour_id'		=> $data->id,
										'filter_tour_schedule_id'=> $schedule->id,
										'tour_schedule_order'	=> 'oldest_depart'
									]
		]
	])

	<div class="clearfix mb-lg"></div>

	@include('admin.widgets.tour.schedule_data_table', [
		'widget_template' 	=> 'plain',
		'widget_title' 		=> 'Tour Schedules',
		'widget_title_class'=> 'text-light',
		'widget_options' 	=> [
									'data'	=> [
										'filter_tour_id'		=> $data->id,
										'tour_schedule_order'	=> 'oldest_depart'
									]
		]
	])
@overwrite