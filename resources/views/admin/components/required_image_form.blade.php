<div class='required_image_container'>
	@forelse ($required_images as $field_name => $label)
		<div class='mb-sm'>
			<strong class='text-uppercase'>{{$label}} URL</strong>
			<div class="row">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
					@if (Input::old($field_name) || ($data->images && $data->images->where('name', $field_name)->first()->path))
						<img src='{{Input::old($field_name, $data->images ? $data->images->where('name', $field_name)->first()->path : '')}}' class='thumbnail img-responsive'>
					@else
						<img src='http://placehold.it/200?text=no+image' class='thumbnail img-responsive'>
					@endif
				</div>
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
					@if ($errors->has($field_name))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get($field_name))}}</span>
					@endif
					{!! Form::text($field_name, Input::old($field_name, ($data->images ? $data->images->where('name', $field_name)->first()->path : '')), [
															'class' 			=> 'form-control image-url', 
															'placeholder' 		=> 'http://', 
															'required' 			=> 'required',
															'data-toggle' 		=> ($errors->has($field_name) ? 'tooltip' : ''), 
															'data-placement' 	=> 'bottom', 
															'title' 			=> ($errors->has($field_name) ? $errors->first($field_name) : ''), 
															]) 
					!!}

					<br>
					{!! Form::textarea($field_name.'_description', Input::old($field_name, ($data->images ? $data->images->where('name', $field_name)->first()->description : '')), [
															'class' 			=> 'form-control', 
															'placeholder' 		=> 'description', 
															'data-toggle' 		=> ($errors->has($field_name.'_description') ? 'tooltip' : ''), 
															'data-placement' 	=> 'bottom', 
															'title' 			=> ($errors->has($field_name.'_description') ? $errors->first($field_name.'_description') : ''), 
															]) 
					!!}
				</div>
			</div>
		</div>

		<hr>
	@empty
	@endforelse
</div>

@section('js')
	@parent

	<script>
		$('.required_image_container').on('blur', '.image-url', function(event) {
			/* Act on the event */
			$(this).parent().parent().find('img.thumbnail').attr('src', $(this).val());
		});
	</script>
@stop