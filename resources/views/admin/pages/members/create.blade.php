@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.nav_detail', [
				'widget_template' 	=> "plain", 
				'user'		=> $data
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.form', [
		'widget_template' 	=> 'plain', 
		'user'				=> $data,
	])
@overwrite