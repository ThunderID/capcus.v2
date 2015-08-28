@section('content_title')
	VENDOR
@overwrite

@section('content_sidebar')
	@include('admin.widgets.vendor.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.vendor.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_title' 		=> 'THIS VENDOR', 
				'widget_options' 	=> [
					'data' => ['filter_vendor_id' => $data->id]
				]
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.vendor.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
			'data' => [
				'filter_vendor_id'		=> ($data->id ? $data->id : 0),
				'filter_category_type'	=> 'vendor'
			]
		]
	])
@overwrite