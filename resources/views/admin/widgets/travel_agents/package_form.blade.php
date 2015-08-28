<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['travel_agent', 'package_list'];
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
		{{$widget_title or "Schedule Form"}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.package', ['travel_agent_id' => $travel_agent->id, 'package_id' => $package->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="mb-xs">
					<strong class='text-uppercase'>Active Since</strong>
					@if ($errors->has('active_since'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_since'))}}</span>
					@endif

					{!! Form::input('text', 'active_since', ($package->active_since ? $package->active_since->format('d/m/Y') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('active_since') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_since') ? $errors->first('active_since') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Active Until</strong>
					@if ($errors->has('active_until'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_until'))}}</span>
					@endif
					{!! Form::input('text', 'active_until', ($package->active_until ? $package->active_until->format('d/m/Y') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('active_until') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_until') ? $errors->first('active_until') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Package </strong>
					@if ($errors->has('package'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('package'))}}</span>
					@endif
					{!! Form::select('package', $package_list->lists('name', 'id'), $package->id, [
																	'class' 			=> 'form-control',
																	'data-toggle'		=> ($errors->has('package') ? 'tooltip' : ''), 
																	'data-placement'	=> 'left', 
																	'title' 			=> ($errors->has('package') ? $errors->first('package') : ''), 
																 ])
					!!}
				</div>

				<div class="col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
				</div>
			</div>
		</div>

		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif