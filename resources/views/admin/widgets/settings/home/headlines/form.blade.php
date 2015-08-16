<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['headline', 'travel_agents'];
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
		@if ($headline->id)
			Edit Headline: {{$headline->name}}
		@else
			Create new Headline:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.headlines.store', ['id' => $headline->id]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Title</strong>
						@if ($errors->has('title'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('title'))}}</span>
						@endif
						{!! Form::text('title', $headline->title, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter title here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('title') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('title') ? $errors->first('title') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Travel Agent</small> </strong>
						@if ($errors->has('sort_index'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('sort_index'))}}</span>
						@endif
						@if ($headline->vendor)
							<p>{{$headline->vendor}}
						@else
							{!! Form::select('vendor', $travel_agents->lists('name', 'id')->toArray(), $headline->vendor_id, [
																	'class' 			=> 'form-control select2', 
																	'placeholder' 		=> 'enter travel agent the headline belongs to', 
																	'data-toggle' 		=> ($errors->has('vendor') ? 'tooltip' : ''), 
																	'data-placement' 	=> 'bottom', 
																	'title' 			=> ($errors->has('vendor') ? $errors->first('vendor') : ''), 
																]) 
							!!}
						@endif
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Priority (Smaller priority displayed first)</small> </strong>
						@if ($errors->has('priority'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('priority'))}}</span>
						@endif
						{!! Form::select('priority', range(1,100), $headline->priority, [
																'class' 			=> 'form-control select2', 
																'data-toggle' 		=> ($errors->has('priority') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('priority') ? $errors->first('priority') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Link To</small> </strong>
						@if ($errors->has('link_to'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('link_to'))}}</span>
						@endif
						{!! Form::text('link_to', $headline->link_to, [
																'class' 			=> 'form-control select2', 
																'placeholder' 		=> 'http://', 
																'data-toggle' 		=> ($errors->has('link_to') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('link_to') ? $errors->first('link_to') : ''), 
															]) 
						!!}
					</div>
				</div>
				@if (!empty($required_images))
					<div class="well">
						<div class='title'>Images</div>
						@include('admin.components.required_image_form', ['required_images' => $required_images, 'data' => $headline])
					</div>
				@endif
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">

				<div class="well">
					<div class='title'>PUBLISH</div>
					<strong class='text-uppercase'>Active Since <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('active_since'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_since'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'active_since', ($headline->active_since ? $headline->active_since->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('active_since') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_since') ? $errors->first('active_since') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

					<div class="clearfix mt-sm"></div>

					<strong class='text-uppercase'>Active Until <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('active_until'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_until'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'active_until', ($headline->active_until ? $headline->active_until->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('active_until') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_until') ? $errors->first('active_until') : ''), 
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