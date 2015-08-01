@section('content_title')
	ARTICLE
@stop

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@include('admin.widgets.headlines.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_headline_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.headlines.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => ['filter_headline_id'			=> $data->id],
								]
			])
@stop