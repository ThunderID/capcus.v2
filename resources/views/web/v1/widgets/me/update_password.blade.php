@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Update Password"}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => route('web.me.update_password.post'), 'method' => 'POST']) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='mb-sm'>
						<strong class='text-uppercase'>Password Sekarang</strong>
						@if ($errors->has('password_sekarang'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('password_sekarang'))}}</span>
						@endif
						{!! Form::password('password_sekarang', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('password_sekarang') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('password_sekarang') ? $errors->first('password_sekarang') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Password Baru</strong>
						@if ($errors->has('password_baru'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('password_baru'))}}</span>
						@endif
						{!! Form::password('password_baru', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('password_baru') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('password_baru') ? $errors->first('password_baru') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Konfirmasi Password Baru</strong>
						@if ($errors->has('konfirmasi_password_baru'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('konfirmasi_password_baru'))}}</span>
						@endif
						{!! Form::password('konfirmasi_password_baru', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> '', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('konfirmasi_password_baru') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('konfirmasi_password_baru') ? $errors->first('konfirmasi_password_baru') : ''), 
																]) 
						!!}
					</div>

					<button type='submit' class='btn btn-default btn-block'>Update Password</button>

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