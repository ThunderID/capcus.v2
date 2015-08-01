@section('content_title')
	VENDOR
@overwrite

@section('content_sidebar')
	@include('admin.widgets.vendor.nav')
	<hr/>
	@include('admin.widgets.vendor.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_options' 	=> [
									'data' => [
												'filter_vendor_id' => $data->id
											]
		]
	])
@overwrite

@section('content_body')
	@include('admin.widgets.vendor.detail', [
		'widget_template' 	=> 'plain',
		'widget_options' 	=> [
									'data'	=> [
										'filter_vendor_id'	=> $data->id
									]
		]
	])
@overwrite