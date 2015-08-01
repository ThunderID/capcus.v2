@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

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
						{!! Form::text('nama', $UserComposer['widget_data']['data']['user_db']->name, [
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
						{!! Form::text('email', $UserComposer['widget_data']['data']['user_db']->email, [
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
						{!! Form::select('gender', ['pria' => 'Pria', 'wanita' => 'Wanita'], $UserComposer['widget_data']['data']['user_db']->gender, [
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
						{!! Form::text('telp', $UserComposer['widget_data']['data']['user_db']->telp, [
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
						{!! Form::text('tgl_lahir', !is_null($UserComposer['widget_data']['data']['user_db']->dob) && $UserComposer['widget_data']['data']['user_db']->dob->year != -1 ? $UserComposer['widget_data']['data']['user_db']->dob->format('d/m/Y') : '', [
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