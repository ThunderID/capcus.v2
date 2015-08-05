<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['user'];
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
		@if ($user->id)
			Edit Admin: {{$user->{$user->getNameField()} }}
		@else
			Create new Admin: {{$user_type}}
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $user->id]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $user->name, [
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
						<strong class='text-uppercase'>Email</strong>
						@if ($errors->has('email'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('email'))}}</span>
						@endif
						{!! Form::text('email', $user->email, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter email here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('email') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('email') ? $errors->first('email') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>password</strong>
						@if ($errors->has('password'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('password'))}}</span>
						@endif
						{!! Form::password('password', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter password here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('password') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('password') ? $errors->first('password') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>password confirmation</strong>
						@if ($errors->has('password_confirmation'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('password_confirmation'))}}</span>
						@endif
						{!! Form::password('password_confirmation', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter password confirmation here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('password_confirmation') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : ''), 
																]) 
						!!}
					</div>
				</div>
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
@endif