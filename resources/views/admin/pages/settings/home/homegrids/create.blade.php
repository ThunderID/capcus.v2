@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
@overwrite

@section('content_body')
	@include('admin.widgets.'.$view_name.'.homegrids.form', [
		'widget_template' 	=> 'plain', 
		'place'				=> $data,
		'destinations' 		=> $destinations
		])
@overwrite