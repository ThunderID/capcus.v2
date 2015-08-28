@if ($widget_error_count)
	<div class="alert alert-danger">
		<h4>{{$widget_name}}</h4>
		@if (is_array($widget_composers))
			@foreach ($widget_composers as $composer)
				@foreach (${$composer}['widget_errors']->all('<li>:message</li>') as $message)
					{!! $message !!}
				@endforeach
			@endforeach
		@endif
	</div>
@else
	<h4 class='text-bold text-uppercase mb-0 pb-0 {{$widget_title_class}}'>
		@yield('widget_title','[widget_title]')
	</h4>
	<hr>
	<div class='{{$widget_body_class}}'>
		@yield('widget_body','[widget_body]')
	</div>
@endif
