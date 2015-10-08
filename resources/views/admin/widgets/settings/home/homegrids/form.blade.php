<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['homegrid', 'homegrid_no', 'homegrid_types', 'destination_list'];
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
		Set Grid #{{$homegrid_no}}
	@overwrite

	@section('widget_body')

		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.homegrids.store', ['homegrid_no' => $homegrid_no]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Type</strong>
						@if ($errors->has('type'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('type'))}}</span>
						@endif
						{!! Form::select('type', $homegrid_types,$homegrid->type, [
																'class' 			=> 'form-control select2 grid-type', 
																'placeholder' 		=> 'Please select grid type',
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('type') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('type') ? $errors->first('type') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Title</strong>
						@if ($errors->has('title'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('title'))}}</span>
						@endif
						{!! Form::text('title', $homegrid->title, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('title') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('title') ? $errors->first('title') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Show Title</strong>
						@if ($errors->has('show_title'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('show_title'))}}</span>
						@endif
						{!! Form::select('show_title', [1 => "Yes", 0 => "No"], ($homegrid->show_title ? 1 : 0), [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('show_title') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('show_title') ? $errors->first('show_title') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Label</strong>
						@if ($errors->has('label'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('label'))}}</span>
						@endif
						{!! Form::text('label', $homegrid->label, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('label') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('label') ? $errors->first('label') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Image URL (360x360)</strong>
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

					{{-- DESTINATION & FEATURED DESTINATION --}}
					@include('admin.components.homegrid.form_destination')

					{{-- SCRIPT --}}
					{{-- @include('admin.components.homegrid.form_script') --}}
					
					{{-- Tour tag --}}
					@include('admin.components.homegrid.form_tour_tag')

					{{-- Link --}}
					@include('admin.components.homegrid.form_link')


					{{-- PLACE --}}

				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">

				<div class="well">
					<div class='title'>SAVE</div>

					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
				</div>
			</div>
		</div>

		{!! Form::close() !!}
	@overwrite

	@section('js')
		@parent

		<script>
			function toggle_grid_form(current_val)
			{
				if (current_val)
				{
					$('.grid_type_form:not(.grid_type_'+current_val+')').slideUp();
					$('.grid_type_'+current_val).slideDown();
				}
				else
				{
					$('.grid_type_form').slideUp();
				}
			}
			$('.grid-type').on("change keyup mouseup", function(e) {
				toggle_grid_form($(this).val());
			})

			$(document).ready(function(){
				toggle_grid_form($('select[name=type]').val());
			});

			$('input[name=image_url]').keyup(function(e) {
				var obj = $(this);
				var code = e.keyCode || e.which;
				if(code == 13) 
				{ 
					$('.grid_type_destination #destination_img_preview').html('<img src="'+obj.val()+'">');
				}
			});

			$('input[name=image_url]').blur(function(e) {
				var obj = $(this);
				$('.grid_type_destination #destination_img_preview').html('<img src="'+obj.val()+'">');
			});
		</script>
	@stop
@endif