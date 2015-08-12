@section('content_title')
	Admin
@overwrite

@section('content_sidebar')
	@include('admin.widgets.admin.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.admin.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_title' 		=> 'This Admin', 
				'widget_options' 	=> [
					'data' => [
								'filter_user_id'		=> ($data->id ? $data->id : 0),
								'filter_user_type'		=> 'admin',
							]
				]
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.admin.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
			'data' => [
				'filter_user_id'		=> ($data->id ? $data->id : 0),
				'filter_user_type'		=> 'admin',
			]
		]
	])
@overwrite