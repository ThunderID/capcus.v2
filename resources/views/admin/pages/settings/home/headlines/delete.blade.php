@section('content_title')
	ARTICLE
@stop

@section('content_sidebar')
	@include('admin.widgets.'.$route_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$route_name.'.headlines.nav_detail', [
		'widget_template' 	=> "plain",
		'headline'			=> $data
	])
@stop

@section('content_body')
	@include('admin.widgets.'.$route_name.'.headlines.delete', [
			'widget_template' 	=> 'plain',
			'headline'			=> $data
			])
@stop