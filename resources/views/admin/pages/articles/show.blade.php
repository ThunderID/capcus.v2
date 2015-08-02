@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'article'			=> $data
	])
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.detail', [
		'widget_template' 	=> 'plain',
		'article'			=> $data
	])
@overwrite