<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tour', 'travel_agents', 'destinations', 'tour_options', 'places'];
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
		@if ($tour->id)
			Edit Tour: {{$tour->name}}
		@else
			Create new Tour:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $tour->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $tour->name, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('name') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('name') ? $errors->first('name') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Slug <small class='text-primary'>(URL)</small> </strong>
						@if ($errors->has('slug'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('slug'))}}</span>
						@endif
						@if ($tour->slug)
							<p>{{$tour->slug}}
						@else
							{!! Form::text('slug', $tour->slug, [
																	'class' 			=> 'form-control slugify', 
																	'required' 			=> 'required',
																	'data-toggle' 		=> ($errors->has('slug') ? 'tooltip' : ''), 
																	'data-placement' 	=> 'bottom', 
																	'title' 			=> ($errors->has('slug') ? $errors->first('slug') : ''), 
																	'data-slugify'		=> 'name'
																]) 
							!!}
						@endif
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Travel Agent</strong>
						@if ($errors->has('travel_agent'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('travel_agent'))}}</span>
						@endif
						{!! Form::select('travel_agent', $travel_agents->lists('name', 'id'), $tour->travel_agent_id, [
																'class' 			=> 'form-control select2', 
																'placeholder'		=> '-',
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('travel_agent') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('travel_agent') ? $errors->first('travel_agent') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Summary </strong>
						@if ($errors->has('summary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('summary'))}}</span>
						@endif
						{!! Form::textarea('summary', $tour->summary, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('summary') ? 'tooltip' : ''), 
																'data-placement'	=> 'bottom', 
																'title' 			=> ($errors->has('summary') ? $errors->first('summary') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Ittinary </strong>
						@if ($errors->has('ittinary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('ittinary'))}}</span>
						@endif
						{!! Form::textarea('ittinary', $tour->ittinary, [
																'class' 			=> 'form-control wysiwyg', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('ittinary') ? 'tooltip' : ''), 
																'data-placement' 	=> 'right', 
																'title' 			=> ($errors->has('ittinary') ? $errors->first('ittinary') : ''),
																'data-height'		=> 1000 
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
				<div class="well">
					<div class='title'>DURATION</div>
					<div class='mb-sm'>	
						<strong class='text-uppercase'>Day</strong>
						@if ($errors->has('duration_day'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('duration_day'))}}</span>
						@endif
						{!! Form::select('duration_day', range(1,365), $tour->duration_day, [
																'class' 			=> 'form-control select2', 
																'placeholder'		=> '-',
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('duration_day') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('duration_day') ? $errors->first('duration_day') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Night</strong>
						@if ($errors->has('duration_night'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('duration_night'))}}</span>
						@endif
						{!! Form::select('duration_night', range(1,365), $tour->duration_night, [
																'class' 			=> 'form-control select2', 
																'placeholder'		=> '-',
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('duration_night') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('duration_night') ? $errors->first('duration_night') : ''), 
															]) 
						!!}
					</div>
				</div>

				<div class="well">
					<div class='title'>Destinations</div>
					<p>	
						<strong class='text-uppercase'>Destinations</strong>
						@if ($errors->has('destinations'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('destinations'))}}</span>
						@endif
						{!! Form::select('destinations[]', $destinations->lists('path', 'id'), ($tour ? $tour->destinations->lists('id')->toArray() : null), [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('destinations') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('destinations') ? $errors->first('destinations') : ''), 
																'multiple'			=> 'multiple'
															]) 
						!!}
					</p>

					<p>	
						<strong class='text-uppercase'>Places to visit</strong>
						@if ($errors->has('places'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('places'))}}</span>
						@endif
						{!! Form::select('places[]', $places->lists('long_name', 'id'), ($tour->places ? $tour->places->lists('id')->toArray() : null), [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('places') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('places') ? $errors->first('places') : ''), 
																'multiple'			=> 'multiple'
															]) 
						!!}
					</p>
				</div>

				<div class="well">
					<div class='title'>Include/Exclude</div>
					<p>	
						@forelse ($tour_options as $tour_option)
							<label class='text-light'>
								{!! Form::checkbox('tour_options[]', $tour_option->id, (!is_null($tour->options) && ($tour->options->find($tour_option->id)) ? true : false), [])!!} {{ $tour_option->name }}
							</label>
							{!! Form::textarea('tour_options_description_' . $tour_option->id, ($tour->options ? $tour->options->where('id', $tour_option->id)->shift()->pivot->description : '')	, ['class' => 'form-control', 'rows' => 2]) !!}
							<hr>
						@empty
						@endforelse
					</p>
				</div>

				<div class="well hidden-xs hidden-sm hidden-md">
					<div class='title'>PUBLISH</div>
					<strong class='text-uppercase'>Published At <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('published_at'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('published_at'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'published_at', ($tour->published_at->year > 0 ? $tour->published_at->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'data-toggle'		=> ($errors->has('published_at') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('published_at') ? $errors->first('published_at') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
				</div>

				<div class='hidden-lg'>
					<button type='submit' class='btn btn-default btn-block'>Save</button>
				</div>
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
	@overwrite
@endif