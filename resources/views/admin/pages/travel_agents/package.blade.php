@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'travel_agent'		=> $data
	])
@overwrite

@section('content_body')
	@include('admin.widgets.common.plain', [
		'widget_template'	=> 'plain',
		'widget_title' 	=> $data->name . ': Package',
		'widget_body'	=> ''
	])

	@include('admin.widgets.'.$view_name.'.package_form', [
		'widget_template' 	=> 'plain',
		'widget_title' 		=> (!$package->id ? 'Add new package' : 'Edit package: ' . $package->active_since->format('d/m/Y') . ' - ' . $package->active_until->format('d/m/Y')),
		'travel_agent'		=> $data,
		'package'			=> $package,
	])

	<div class="clearfix mb-lg"></div>

	@include('admin.widgets.'.$view_name.'.package_data_table', [
		'widget_template' 	=> 'plain',
		'travel_agent'		=> $data,
	])
@overwrite