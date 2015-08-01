@section('content_title')
	MEMBER
@overwrite

@section('content_sidebar')
	@include('admin.widgets.member.nav')
	<hr/>
	@include('admin.widgets.member.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS MEMBER', 
		'widget_options' 	=> [
									'data' => [
												'filter_user_type'				=> 'member',
												'filter_user_id' 				=> $data->id
											]
		]
	])
@overwrite

@section('content_body')
	@include('admin.widgets.common.plain', [
												'widget_template' 	=> 'plain',
												'widget_title' 		=> 'Member: ' . $data->name
											])

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
			@include('admin.widgets.member.detail', [
				'widget_template' 	=> 'plain',
				'widget_title_class'=> 'text-light text-primary',
				'widget_options' 	=> [
											'data'	=> [
												'filter_user_type'				=> 'member',
												'filter_user_id'				=> $data->id
											]
				]
			])
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
			
		</div>
	</div>
@overwrite