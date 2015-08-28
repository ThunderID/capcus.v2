@section('content_title')
	ARTICLE
@stop

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@include('admin.widgets.headlines.nav_detail', [
		'widget_template' 	=> "plain",
		'headline'			=> $data
	])
@stop

@section('content_body')
	@include('admin.widgets.headlines.delete', [
			'widget_template' 	=> 'plain',
			'headline'			=> $data
			])
@stop