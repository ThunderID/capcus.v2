@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'tour_option'		=> $data
	])
@overwrite

@section('content_body')
@overwrite