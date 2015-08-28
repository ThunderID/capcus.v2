<div class='grid_type_form grid_type_destination grid_type_featured_destination'>
	<div class='mb-sm'>
		<strong class='text-uppercase'>Destination</strong>
		@if ($errors->has('destination'))
			<span class='text-danger pull-right'>{{implode(', ', $errors->get('destination'))}}</span>
		@endif
		{!! Form::select('destination', $destination_list, $homegrid->destination, [
												'class' 			=> 'form-control select2 grid-destination', 
												'placeholder' 		=> 'Please select destination',
												'data-toggle' 		=> ($errors->has('destination') ? 'tooltip' : ''), 
												'data-placement' 	=> 'bottom', 
												'title' 			=> ($errors->has('destination') ? $errors->first('destination') : ''), 
												]) 
		!!}
	</div>

	<div class='mb-sm'>
		<strong class='text-uppercase'>Image URL</strong>
		@if ($errors->has('image_url'))
			<span class='text-danger pull-right'>{{implode(', ', $errors->get('image_url'))}}</span>
		@endif
		{!! Form::text('image_url', $homegrid->image_url, [
												'class' 			=> 'form-control grid-image_url', 
												'placeholder' 		=> 'http://',
												'data-toggle' 		=> ($errors->has('image_url') ? 'tooltip' : ''), 
												'data-placement' 	=> 'bottom', 
												'title' 			=> ($errors->has('image_url') ? $errors->first('image_url') : ''), 
												]) 
		!!}

		<div id='destination_img_preview' class='mt-md text-center'>
			@if ($homegrid->image_url)
				<img src="{{ $homegrid->image_url}}">
			@endif
		</div>
	</div>
</div>


@section('js')
	@parent

	<script>
		$('.grid_type_destination input[name=image_url]').keyup(function(e) {
			var obj = $(this);
			var code = e.keyCode || e.which;
			if(code == 13) 
			{ 
				$('.grid_type_destination #destination_img_preview').html('<img src="'+obj.val()+'">');
			}
		});

		$('.grid_type_destination input[name=image_url]').blur(function(event) {
			var obj = $(this);
			$('.grid_type_destination #destination_img_preview').html('<img src="'+obj.val()+'">');
		});
	</script>
@stop