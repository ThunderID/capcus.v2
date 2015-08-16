@section('content_title')
	HEADLINE
@overwrite

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@include('admin.widgets.headlines.nav_detail', [
		'widget_template' 	=> "plain", 
		'headline'			=> $data
	])
@overwrite

@section('content_body')
	@include('admin.widgets.headlines.detail', [
		'widget_template' 	=> 'plain',
		'headline'			=> $data
	])
@overwrite