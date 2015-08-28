@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.nav_detail', [
				'widget_template' 	=> "plain", 
				'article'			=> $data
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.form', [
		'widget_template' 	=> 'plain', 
		'article'			=> $data,
		'destinations'		=> $destinations,
		'filters'			=> ['title' => $filters['title'], 'writer' => $filters['writer'], 'status' => $filters['status']]
	])
@overwrite