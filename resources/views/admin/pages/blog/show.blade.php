@section('content_sidebar')
	@include('admin.widgets.article.nav')
	<hr/>
	@include('admin.widgets.article.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS ARTICLE', 
		'widget_options' 	=> [
									'data' => [
												'filter_article_id' => $data->id
											]
		]
	])
@overwrite

@section('content_body')
	@include('admin.widgets.article.detail', [
		'widget_template' 	=> 'plain',
		'widget_options' 	=> [
									'data'	=> [
										'filter_article_id'	=> $data->id
									]
		]
	])
@overwrite