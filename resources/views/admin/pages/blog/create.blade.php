@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.nav_detail', [
				'widget_template' 	=> "plain", 
				'widget_options' 	=> [
					'data' => ['filter_article_id' => $data->id]
				]
			])
	@endif
@overwrite

@section('content_body')
{{-- 	@include('admin.widgets.'.$view_name.'.form', [
		'widget_template' 	=> 'plain', 
		'widget_options'	=> [
			'data' => [
				'filter_article_id'		=> ($data->id ? $data->id : 0),
				'filter_category_type'	=> 'article'
			]
		]
	]) --}}
@overwrite