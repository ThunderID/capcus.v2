<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['place', 'destinations'];
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
		@if ($place->id)
			Edit Place: {{$place->path_name}}
		@else
			Create new Place:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $place->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $place->name, [
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
						<strong class='text-uppercase'>Location</strong>
						@if ($errors->has('destination_id'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('destination_id'))}}</span>
						@endif
						{!! Form::select('destination_id', $destinations->lists('path', 'id'), $place->destination_id, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'Please select the region this place located in',
																'data-toggle'		=> ($errors->has('destination_id') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('destination_id') ? $errors->first('destination_id') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Summary</strong>
						@if ($errors->has('summary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('summary'))}}</span>
						@endif
						{!! Form::textarea('summary', $place->summary, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> '',
																'data-toggle'		=> ($errors->has('summary') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('summary') ? $errors->first('summary') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Description</strong>
						@if ($errors->has('content'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('content'))}}</span>
						@endif
						{!! Form::textarea('content', $place->content, [
																'class' 			=> 'form-control wysiwyg', 
																'required' 			=> 'required',
																'placeholder' 		=> '',
																'data-toggle'		=> ($errors->has('content') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('content') ? $errors->first('content') : ''), 
															]) 
						!!}
					</div>
				</div>

				<div class='well'>
					<div class='title'>Locations</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Longitude & Latitude</strong>
						@if ($errors->has('longlat'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('longlat'))}}</span>
						@endif
						{!! Form::text('longlat', $place->longlat, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter longlat here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('longlat') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('longlat') ? $errors->first('longlat') : ''), 
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
					<div class='title'>PUBLISH</div>
					<strong class='text-uppercase'>Published At <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('published_at'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('published_at'))}}</span>
					@endif
					{!! Form::input('text', 'published_at', ($place->published_at->year > 0 ? $place->published_at->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'leave blank to save it as draft',
																						'data-toggle'		=> ($errors->has('published_at') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('published_at') ? $errors->first('published_at') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
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
		</script>
	@stop
@endif