@section('content_title')
	HEADLINE
@overwrite

@section('content_sidebar')
	@include('admin.widgets.headlines.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.headlines.nav_detail', [
				'widget_template' 	=> "plain", 
				'headline'			=> $data
			])
	@endif
@overwrite

@section('content_body')
	@include('admin.widgets.headlines.form', [
		'widget_template' 	=> 'plain', 
		'headline'			=> $data
	])
@overwrite