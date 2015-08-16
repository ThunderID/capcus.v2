<div class='grid_type_form grid_type_script'>
	<div class='mb-sm'>
		<strong class='text-uppercase'>Script</strong>
		@if ($errors->has('script'))
			<span class='text-danger pull-right'>{{implode(', ', $errors->get('script'))}}</span>
		@endif
		{!! Form::textarea('script', $homegrid->script, [
												'class' 			=> 'form-control', 
												'required' 			=> 'required',
												'data-toggle' 		=> ($errors->has('script') ? 'tooltip' : ''), 
												'data-placement' 	=> 'bottom', 
												'title' 			=> ($errors->has('script') ? $errors->first('script') : ''), 
												]) 
		!!}
	</div>
</div>


@section('js')
	@parent

	<script>
		$('#grid_type_destination').on('change', '.grid-image_url', function(event) {
			var obj = $(this);
			$('#grid_type_destination #destination_img_preview').html('<img src="'+obj.val()+'">');
		});
	</script>
@stop