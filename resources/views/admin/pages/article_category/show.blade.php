@section('content_title')
	BLOG CATEGORY
@overwrite

@section('content_sidebar')
	@include('admin.widgets.'.$route_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$route_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS CATEGORY', 
		'widget_options' 	=> [
								'data' => [
												'filter_category_id' => $data->id,
												'filter_category_type'		=> 'article'
											]
		]
	])
@overwrite

@section('content_body')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<article>
				@include('admin.widgets.common.plain', [
						'widget_template' 	=> 'plain',
						'widget_title'		=>  $data->name . ' <small class="text-primary">(' . $data->path_name. ')</small>',
					])
				@include('admin.widgets.article.data_table', [
						'widget_title'		=> 'Article',
						'widget_options'	=> [
												'data' => [
															'filter_category_type'		=> 'article',
															'filter_user_type'			=> 'admin',
															'filter_article_category'	=> $data->id,
															'article_paginate'			=> 25,
															'article_current_page'		=> Input::get('page'),
															'article_order'				=> 'latest',
												] 
											]
					])
					
			</article>
		</div>
	</div>
@overwrite