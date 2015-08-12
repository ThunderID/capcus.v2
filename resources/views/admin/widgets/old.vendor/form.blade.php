@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($VendorComposer['widget_data']['data']['vendor_db']->id)
			Edit Vendor: {{$VendorComposer['widget_data']['data']['vendor_db']->name}}
		@else
			Create new vendor:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.vendor.store', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $VendorComposer['widget_data']['data']['vendor_db']->name, [
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
						<strong class='text-uppercase'>Slug <small class='text-primary'>(URL)</small> </strong>
						@if ($errors->has('slug'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('slug'))}}</span>
						@endif
						@if ($VendorComposer['widget_data']['data']['vendor_db']->slug)
							<p>{{$VendorComposer['widget_data']['data']['vendor_db']->slug}}
						@else
							{!! Form::text('slug', $VendorComposer['widget_data']['data']['vendor_db']->slug, [
																	'class' 			=> 'form-control slugify', 
																	'placeholder' 		=> 'enter slug here', 
																	'required' 			=> 'required',
																	'data-toggle' 		=> ($errors->has('slug') ? 'tooltip' : ''), 
																	'data-placement' 	=> 'bottom', 
																	'title' 			=> ($errors->has('slug') ? $errors->first('slug') : ''), 
																	'data-slugify'		=> 'name'
																]) 
							!!}
						@endif
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Summary </strong>
						@if ($errors->has('summary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('summary'))}}</span>
						@endif
						{!! Form::textarea('summary', $VendorComposer['widget_data']['data']['vendor_db']->summary, [
																'class' 			=> 'form-control wysiwyg', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter summary here',
																'data-toggle'		=> ($errors->has('summary') ? 'tooltip' : ''), 
																'data-placement'	=> 'bottom', 
																'title' 			=> ($errors->has('summary') ? $errors->first('summary') : ''), 
																]) 
						!!}
					</div>

				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="well">
					<div class='title'>LOGO</div>
					<p>	
						<strong class='text-uppercase'>LOGO URL <small>Small</small></strong>
						@if ($errors->has('logo'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('logo'))}}</span>
						@endif
						{!! Form::text('small_logo', $VendorComposer['widget_data']['data']['vendor_db']->logo_sm, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter small logo url here',
																'data-toggle'		=> ($errors->has('small_logo') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('small_logo') ? $errors->first('small_logo') : ''), 
															]) 
						!!}

					</p>
						<strong class='text-uppercase'>LOGO URL <small>(Large)</small></strong>
						@if ($errors->has('logo'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('logo'))}}</span>
						@endif
						{!! Form::text('large_logo', $VendorComposer['widget_data']['data']['vendor_db']->logo_lg, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter large logo url here',
																'data-toggle'		=> ($errors->has('large_logo') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('large_logo') ? $errors->first('large_logo') : ''), 
															]) 
						!!}
					</p>

					<p><img id='thumbnail_container' src="" class="img-responsive"></p>

				</div>

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