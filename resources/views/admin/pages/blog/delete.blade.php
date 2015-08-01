@section('content_sidebar')
	@include('admin.widgets.article.nav')
	<hr/>
	@include('admin.widgets.article.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_article_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.article.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
										'data' => ['filter_article_id'			=> $data->id],
								]
			])
@stop