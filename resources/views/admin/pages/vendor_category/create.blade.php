@section('content_title')
	VENDOR CATEGORIES
@overwrite

@section('content_sidebar')
	@include('admin.widgets.vendor_category.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.vendor_category.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_options' 	=> [
					'data'	=> [
								'filter_category_type' => 'vendor',
								'filter_category_id' => $data->id
								]
				]
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.vendor_category.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
								'data'	=> [
												'filter_category_type'	=> 'vendor',
												'filter_category_id'	=> ($data->id ? $data->id : 0),
											],
								'parent_category_list' => [
												'filter_category_type'				=> 'vendor',
												'filter_category_except_subtree'	=> $data->id,
											]
								]
		])
@overwrite