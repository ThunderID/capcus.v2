@section('content_title')
	HEADLINE
@overwrite

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.headlines.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_title' 		=> 'THIS HEADLINE', 
				'widget_options' 	=> [
					'data' => ['filter_headline_id' => $data->id]
				]
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.headlines.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
			'data' => [
				'filter_headline_id'		=> ($data->id ? $data->id : 0),
				'vendor_order'				=> 'name'
			]
		]
	])
@overwrite