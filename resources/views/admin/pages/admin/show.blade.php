@section('content_title')
	ADMIN
@overwrite

@section('content_sidebar')
	@include('admin.widgets.admin.nav')
	<hr/>
	@include('admin.widgets.admin.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS MEMBER', 
		'widget_options' 	=> [
									'data' => [
												'filter_user_type'				=> 'admin',
												'filter_user_id' 				=> $data->id
											]
		]
	])
@overwrite

@section('content_body')
	@include('admin.widgets.common.plain', [
												'widget_template' 	=> 'plain',
												'widget_title' 		=> 'Admin: ' . $data->name
											])

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
			@include('admin.widgets.admin.detail', [
				'widget_title_class'=> 'text-light text-primary',
				'widget_options' 	=> [
											'data'	=> [
												'filter_user_type'				=> 'admin',
												'filter_user_id'				=> $data->id
											]
				]
			])
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
			
		</div>
	</div>
@overwrite