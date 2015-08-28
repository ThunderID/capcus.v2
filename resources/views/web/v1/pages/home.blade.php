@section('desktop_main_logo')
	<a href="{{route('web.home')}}">
		<img src="{{asset('images/'.$main_logo['result']['file_url'])}}" alt="{{$main_logo['img_alt']}}" class='{{$main_logo['img_class'] or ""}}'>
	</a>
@stop

@section('content_header')
	<div class='row'>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@include('web.v1.widgets.headlines.carousel', ['carousel_items' => $headlines])
		</div>
	</div>
@stop

@section('content_body')
	<div class="row">
		<div class="clearfix mb-sm"></div>	

		<div class="hidden-xs hidden-sm col-md-12 hidden-lg">
			@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
		
			<div class='text-center hidden-md mb-sm'>
				@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			<div class='mb-md'>
				@include("web.v1.widgets.tours.grid", ['tours' => $tours])
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
			@include('web.v1.widget_group.sidebar.basic')
		</div>
	</div>
@stop