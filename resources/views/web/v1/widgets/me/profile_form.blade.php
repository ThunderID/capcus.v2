<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Me:Profile_form';

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


@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Edit Profile"}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => route('web.me.profile.post'), 'method' => 'POST']) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='mb-sm'>
						<strong class='text-uppercase'>Nama</strong>
						@if ($errors->has('nama'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('nama'))}}</span>
						@endif
						{!! Form::text('nama', $user->name, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('nama') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('nama') ? $errors->first('nama') : ''), 
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
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('email') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('email') ? $errors->first('email') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Gender</strong>
						@if ($errors->has('gender'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('gender'))}}</span>
						@endif
						{!! Form::select('gender', ['pria' => 'Pria', 'wanita' => 'Wanita'], $user->gender, [
																'class' 			=> 'form-control select2', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('gender') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('gender') ? $errors->first('gender') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Telp</strong>
						@if ($errors->has('telp'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('telp'))}}</span>
						@endif
						{!! Form::text('telp', $user->telp, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('telp') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('telp') ? $errors->first('telp') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Tgl Lahir</strong>
						@if ($errors->has('tgl_lahir'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('tgl_lahir'))}}</span>
						@endif
						{!! Form::text('tgl_lahir', !is_null($user->dob) && $user->dob->year != -1 ? $user->dob->format('d/m/Y') : '', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('tgl_lahir') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('tgl_lahir') ? $errors->first('tgl_lahir') : ''), 
																'data-inputmask'	=> "'alias':'date'"
																]) 
						!!}
					</div>

					<button type='submit' class='btn btn-default btn-block'>Simpan</button>

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