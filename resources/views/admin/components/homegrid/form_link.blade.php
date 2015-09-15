<div class='grid_type_form grid_type_link'>
	<div class='mb-sm'>
		<strong class='text-uppercase'>link</strong>
		@if ($errors->has('link'))
			<span class='text-danger pull-right'>{{implode(', ', $errors->get('link'))}}</span>
		@endif
		{!! Form::text('link', $homegrid->link, [
												'class' 			=> 'form-control', 
												'placeholder' 		=> 'http://',
												'data-toggle' 		=> ($errors->has('link') ? 'tooltip' : ''), 
												'data-placement' 	=> 'bottom', 
												'title' 			=> ($errors->has('link') ? $errors->first('link') : ''), 
												]) 
		!!}
	</div>
</div>