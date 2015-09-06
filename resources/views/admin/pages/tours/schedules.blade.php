@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'tour'				=> $data
	])
@overwrite

@section('content_body')
	@include('admin.widgets.common.plain', [
		'widget_template'	=> 'plain',
		'widget_title' 	=> $data->name . ' by ' . $data->travel_agent->name,
		'widget_body'	=> ''
	])

	@include('admin.widgets.'.$view_name.'.schedule_form', [
		'widget_template' 	=> 'plain',
		'widget_title' 		=> (!$schedule->id ? 'Add new schedule' : 'Edit Schedule: ' . $schedule->departure->format('d/m/Y')),
		'tour'				=> $data,
		'schedule'			=> $schedule,
	])

	<div class="clearfix mb-lg"></div>

	@include('admin.widgets.'.$view_name.'.schedule_data_table', [
		'widget_template' 	=> 'plain',
		'tour'				=> $data,
		'schedules'			=> $data->schedules->sortBy('departure'),
	])
@overwrite