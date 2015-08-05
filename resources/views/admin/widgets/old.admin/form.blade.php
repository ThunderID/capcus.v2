@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($UserComposer['widget_data']['data']['user_db']->id)
			Edit Admin: {{$UserComposer['widget_data']['data']['user_db']->name}}
		@else
			Create new Admin:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $UserComposer['widget_data']['data']['user_db']->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $UserComposer['widget_data']['data']['user_db']->name, [
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
						{!! Form::text('email', $UserComposer['widget_data']['data']['user_db']->email, [
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
						@if ($UserComposer['widget_data']['data']['user_db']->id)
							<p>
								To leave the old password please leave the form below empty
							</p>
						@endif

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

						<p class='mt-xs'>Please retype your password</p>
						{!! Form::password('password_confirmation', [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter password confirmation here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('password') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('password') ? $errors->first('password') : ''), 
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