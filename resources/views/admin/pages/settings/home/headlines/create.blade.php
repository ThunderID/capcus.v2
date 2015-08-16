@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.headlines.nav_detail', [
				'widget_template' 	=> "plain", 
				'headline'			=> $data
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.headlines.form', [
		'widget_template' 	=> 'plain', 
		'headline'			=> $data
	])
@overwrite


