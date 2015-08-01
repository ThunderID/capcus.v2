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
	@include('admin.widgets.common.plain', [
		'widget_template'	=> 'plain',
		'widget_title' 	=> $data->name . ' : Subscription',
		'widget_body'	=> ''
	])

	@include('admin.widgets.vendor.subscription_form', [
		'widget_template' 	=> 'plain',
		'widget_title_class'=> 'text-light',
		'widget_options' 	=> [
									'data'	=> [
										'filter_category_type'		=> 'vendor',
										'filter_vendor_id'			=> $data->id,
										'filter_vendor_subscription_id'	=> $subscription_id * 1
									]
		]
	])

	<div class="clearfix mb-lg"></div>

	@include('admin.widgets.vendor.subscription_data_table', [
		'widget_template' 	=> 'plain',
		'widget_title_class'=> 'text-light',
		'widget_options' 	=> [
									'data'	=> [
										'filter_vendor_id'		=> $data->id,
										'vendor_subscription_order'	=> 'since',
									]
		]
	])
@overwrite