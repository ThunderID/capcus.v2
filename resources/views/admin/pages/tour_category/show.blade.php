@section('content_title')
	VENDOR CATEGORIES
@overwrite

@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@include('admin.widgets.'.$view_name.'.nav_detail', [
		'widget_template' 	=> "plain", 
		'widget_title' 		=> 'THIS CATEGORY', 
		'widget_options' 	=> [
								'data' => [
												'filter_category_id' => $data->id,
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

				@include('admin.widgets.tour.data_table', [
						'widget_template'	=> 'plain',
						'widget_title'		=> 'Tour to this destination',
						'widget_title_class'=> 'text-light',
						'widget_options'	=> [
												'data' => [
															'filter_category_type'		=> 'vendor',
															'filter_tour_category'		=> $data->id,
															'tour_paginate'				=> 25,
															'tour_current_page'			=> Input::get('page'),
															'tour_order'				=> 'latest',
												] 
											]
					])
					
			</article>
		</div>
	</div>
@overwrite