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
	<div class="{{$widget_body_class}}">
		@yield('widget_body','[widget_body]')
	</div>
@endif
