<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['destination', 'parent_destinations'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($destination->id)
			Edit Destination: {{$destination->path_name}}
		@else
			Create new Destination:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $destination->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $destination->name, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter name here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('name') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('name') ? $errors->first('name') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Subregion Of</strong>
						@if ($errors->has('parent_id'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('parent_id'))}}</span>
						@endif
						{!! Form::select('parent_id', $parent_destinations->lists('path', 'id'), $destination->parent_id, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'Please select the region this destination located in',
																'data-toggle'		=> ($errors->has('parent_id') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('parent_id') ? $errors->first('parent_id') : ''), 
															]) 
						!!}
					</div>
				</div>


				@if (!empty($required_images))
					<div class="well">
						<div class='title'>Images</div>
						@include('admin.components.required_image_form', ['required_images' => $required_images, 'data' => $destination])
					</div>
				@endif
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="well hidden-xs hidden-sm hidden-md">
					<div class='title'>SAVE</div>

					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
				</div>

				<div class='hidden-lg'>
					<button type='submit' class='btn btn-default btn-block'>Save</button>
				</div>
			</div>
		</div>

		{!! Form::close() !!}
	@overwrite

	@section('js')
		@parent

		<script>
			$('.subarticle-dropdown').on("select2:unselect", function(e) {
				$(this).find('option[value='+e.params.data.id+']').remove()
				e.preventDefault();
	        })

	        $('.image-url').on('blur',function(){
	        	$(this).parent().parent().find('img.thumbnail').attr('src', $(this).val() ? $(this).val() : 'http://placehold.it/200?text=no+image');
	        });
		</script>
	@stop
@endif