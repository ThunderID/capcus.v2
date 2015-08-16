@section('content_title')
	HEADLINE
@overwrite

@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.headlines.nav_detail', [
		'widget_template' 	=> "plain", 
		'headline'			=> $data
	])
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.headlines.detail', [
		'widget_template' 	=> 'plain',
		'headline'			=> $data
	])
@overwrite