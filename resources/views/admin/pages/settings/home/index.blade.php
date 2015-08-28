@section('content_sidebar')
	@include('admin.widgets.'.$view_name.'.nav')
	<hr>
@stop

@section('content_body')
	<h4 class='text-bold text-uppercase mb-0 pb-0 '>HEADLINES</h1>
	<hr>

	<div class="row mb-md">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a href="{{ route('admin.'.$route_name.'.headlines.create') }}" class='btn btn-default'><i class='fa fa-plus'></i></a>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
			<a href="{{ route('admin.'.$route_name.'.headlines.index') }}" class='btn btn-default'><i class='fa fa-calendar'></i> Check Schedules</a>
		</div>
	</div>
	
	@include('admin.widgets.'.$view_name.'.headlines.data_table', [
			'headlines'			=> $current_headlines
		])

	@include('admin.widgets.'.$view_name.'.homegrids.data_table', [
			'widget_template' 	=> 'plain',
			'homegrids'			=> $homegrids
		])
@stop