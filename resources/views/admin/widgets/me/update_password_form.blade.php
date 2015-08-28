@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or 'Update Password'}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $TourComposer['widget_data']['data']['form_url'], 'method' => 'post', 'class' => 'form']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="well">
					<div class='title'>Update Password</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Current Password</strong>
						@if ($errors->has('current_password'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('current_password'))}}</span>
						@endif
						{!! Form::password('current_password', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter current password here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('current_password') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('current_password') ? $errors->first('current_password') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>New Password</strong>
						@if ($errors->has('new_password'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('new_password'))}}</span>
						@endif
						{!! Form::password('new_password', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter new password here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('new_password') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('new_password') ? $errors->first('new_password') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>New Password Confirmation</strong>
						@if ($errors->has('new_password_confirmation'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('new_password_confirmation'))}}</span>
						@endif
						{!! Form::password('new_password_confirmation', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter new password confirmation here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('new_password_confirmation') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('new_password_confirmation') ? $errors->first('new_password_confirmation') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<button type='submit' class='btn btn-default'>Submit</button>
					</div>
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