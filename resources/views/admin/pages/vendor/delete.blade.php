@section('content_title')
	VENDOR
@stop

@section('content_sidebar')
	@include('admin.widgets.vendor.nav')
	<hr/>
	@include('admin.widgets.vendor.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_vendor_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.vendor.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => ['filter_vendor_id'			=> $data->id],
								]
			])
@stop