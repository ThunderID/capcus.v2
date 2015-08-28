@section('content_title')
	VENDOR CATEGORIES
@overwrite

@section('content_sidebar')
	@include('admin.widgets.'.$route_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$route_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS CATEGORY', 
		'widget_options' 	=> [
								'data' => [
												'filter_category_id' => $data->id,
											]
		]
	])
@overwrite

@section('content_body')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<article>
				@include('admin.widgets.common.plain', [
						'widget_template' 	=> 'plain',
						'widget_title'		=>  $data->name . ' <small class="text-primary">(' . $data->path_name. ')</small>',
					])
				@include('admin.widgets.vendor.data_table', [
						'widget_title'		=> 'Vendor',
						'widget_options'	=> [
												'data' => [
															'filter_category_type'		=> 'vendor',
															'filter_vendor_category'	=> $data->id,
															'vendor_paginate'			=> 25,
															'vendor_current_page'		=> Input::get('page'),
															'vendor_order'				=> 'latest',
												] 
											]
					])
					
			</article>
		</div>
	</div>
@overwrite