@if ($widget_error_count)
	<div class="alert alert-danger">
		<h4>{{$widget_name}}</h4>
		@if ($widget_errors->count())
			<?php $prev_var_name = ''; ?>
			
			@foreach ($widget_errors->getMessages() as $k => $message)
				<?php 
					$var_name = explode(':', $k);
				?>
				
				@if (!str_is($prev_var_name, $var_name))
					<?php $prev_var_name = $var_name; ?>
					<h4 style='text-transform:uppercase; color:black'>Var: {{$var_name[0]}}</h4>
				@endif

				@foreach ($message as $x)
					<li>{{$x}}</li>
				@endforeach
			@endforeach
		@endif
	</div>
@else
	<div class='{{$widget_class}}'>
		<div class="{{$widget_body_class}}">
			@yield('widget_body','[widget_body]')
		</div>
	</div>
@endif
