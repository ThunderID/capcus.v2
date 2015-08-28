@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr/>
	@if ($data->id)
		@include('admin.widgets.'.$view_name.'.nav_detail', [
				'widget_template' 	=> "plain", 
				'place'				=> $data,
			])
	@endif
@overwrite

@section('content_body')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<article>
				@include('admin.widgets.common.plain', [
						'widget_template' 	=> 'plain',
						'widget_title'		=>  $data->name . ' <small class="text-primary">(' . $data->destination->path. ')</small>',
					])
				
					
			</article>
		</div>
	</div>
@overwrite