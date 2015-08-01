@section('nav')
	@include('admin.widgets.common.nav.top_nav')
@stop

@section('nav_sidebar')
	@include('admin.widgets.common.nav.me', [
												'widget_template'	=> 'plain',
												'widget_title' 		=> 'Hi, ' . Auth::user()->name,
												'widget_title_class'=> 'text-white text-sm pl-5 text-light',
												'widget_options'	=> []
											])

	<div class="clearfix mt-sm"></div>

	@include('admin.widgets.common.nav.menu', [
												'widget_template'	=> 'plain',
												'widget_title' 		=> 'Menu',
												'widget_title_class'=> 'text-white text-sm pl-5 text-light',
												'widget_options'	=> [
																			[
																				
																			]
																		]
											])
@stop