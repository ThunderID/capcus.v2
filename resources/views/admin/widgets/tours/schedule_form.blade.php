<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tour', 'schedule'];
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
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.schedules.store', ['tour_id' => $tour->id, 'id' => $schedule->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="mb-xs">
					<strong class='text-uppercase'>Departure</strong>
					@if ($errors->has('departure'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('departure'))}}</span>
					@endif

					{!! Form::input('text', 'departure', ($schedule->departure ? $schedule->departure->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('departure') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('departure') ? $errors->first('departure') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Departure Until (For Individual Tour Only)</strong>
					@if ($errors->has('departure_until'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('departure_until'))}}</span>
					@endif
					{!! Form::input('text', 'departure_until', ($schedule->departure_until ? $schedule->departure_until->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('departure_until') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('departure_until') ? $errors->first('departure_until') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Currency </strong>
					@if ($errors->has('currency'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('currency'))}}</span>
					@endif
					{!! Form::select('currency', ['IDR' => 'IDR', 'USD' => 'USD'], ($schedule->currency ? $schedule->currency : "IDR"), [
																						'class' 			=> 'form-control select2',
																						'data-toggle'		=> ($errors->has('currency') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('currency') ? $errors->first('currency') : ''), 
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Original Price </strong>
					@if ($errors->has('original_price'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('original_price'))}}</span>
					@endif
					{!! Form::input('numeric', 'original_price', $schedule->original_price, [
																	'class' 			=> 'form-control',
																	'placeholder'		=> '',
																	'data-toggle'		=> ($errors->has('original_price') ? 'tooltip' : ''), 
																	'data-placement'	=> 'left', 
																	'title' 			=> ($errors->has('original_price') ? $errors->first('original_price') : ''), 
																 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Discounted Price (If no discount, please enter same number as original price)</strong>
					@if ($errors->has('discounted_price'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('discounted_price'))}}</span>
					@endif
					{!! Form::input('numeric', 'discounted_price', $schedule->discounted_price, [
																	'class' 			=> 'form-control',
																	'placeholder'		=> '',
																	'data-toggle'		=> ($errors->has('discounted_price') ? 'tooltip' : ''), 
																	'data-placement'	=> 'left', 
																	'title' 			=> ($errors->has('discounted_price') ? $errors->first('discounted_price') : ''), 
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