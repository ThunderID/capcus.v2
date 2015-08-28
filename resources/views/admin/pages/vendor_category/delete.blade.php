@section('content_title')
	VENDOR CATEGORIES
@stop

@section('content_sidebar')
	@include('admin.widgets.article_category.nav')
	<hr/>
	@include('admin.widgets.article_category.nav_detail', [
		'widget_template' 	=> "plain",
		'widget_options'	=> [
									'data' => ['filter_category_id'			=> $data->id],
								]
	])
@stop

@section('content_body')
	@include('admin.widgets.article_category.delete', [
			'widget_template' 	=> 'plain',
			'widget_options'	=> [
									'data'	=> ['filter_category_id'			=> $data->id],
									]
			])
@stop