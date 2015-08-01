@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($HeadlineComposer['widget_data']['data']['headline_db']->id)
			Edit headline: {{$HeadlineComposer['widget_data']['data']['headline_db']->name}}
		@else
			Create new headline:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $HeadlineComposer['widget_data']['data']['headline_db']->id]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $HeadlineComposer['widget_data']['data']['headline_db']->name, [
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
						<strong class='text-uppercase'>Vendor</small> </strong>
						@if ($errors->has('sort_index'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('sort_index'))}}</span>
						@endif
						@if ($VendorComposer['widget_data']['data']['headline_db']->vendor)
							<p>{{$VendorComposer['widget_data']['data']['headline_db']->vendor}}
						@else
							{!! Form::select('vendor', [null => ''] + $VendorComposer['widget_data']['data']['vendor_db']->lists('name', 'id'), $HeadlineComposer['widget_data']['data']['headline_db']->vendor_id, [
																	'class' 			=> 'form-control select2', 
																	'placeholder' 		=> 'enter vendor the headline belongs to', 
																	'data-toggle' 		=> ($errors->has('vendor') ? 'tooltip' : ''), 
																	'data-placement' 	=> 'bottom', 
																	'title' 			=> ($errors->has('vendor') ? $errors->first('vendor') : ''), 
																]) 
							!!}
						@endif
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Sort Index</small> </strong>
						@if ($errors->has('sort_index'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('sort_index'))}}</span>
						@endif
						{!! Form::select('sort_index', range(1,100), $VendorComposer['widget_data']['data']['vendor_db']->sort_index, [
																'class' 			=> 'form-control select2', 
																'placeholder' 		=> 'enter vendor the headline belongs to', 
																'data-toggle' 		=> ($errors->has('sort_index') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('sort_index') ? $errors->first('sort_index') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Link To</small> </strong>
						@if ($errors->has('link_to'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('link_to'))}}</span>
						@endif
						{!! Form::text('link_to', $HeadlineComposer['widget_data']['data']['headline_db']->link_to, [
																'class' 			=> 'form-control select2', 
																'placeholder' 		=> 'enter the url for headline to link to ', 
																'data-toggle' 		=> ($errors->has('link_to') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('link_to') ? $errors->first('link_to') : ''), 
															]) 
						!!}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">

				<div class="well">
					<div class='title'>Slider Image</div>
					<p>	
						<strong class='text-uppercase'>Small Image URL</strong>
						@if ($errors->has('small_image'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('small_image'))}}</span>
						@endif
						{!! Form::text('small_image', $HeadlineComposer['widget_data']['data']['headline_db']->image_sm, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter small image url here',
																'data-toggle'		=> ($errors->has('small_image') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('small_image') ? $errors->first('small_image') : ''), 
															]) 
						!!}
					</p>

					<p>	
						<strong class='text-uppercase'>Large Image URL</strong>
						@if ($errors->has('large_image'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('large_image'))}}</span>
						@endif
						{!! Form::text('large_image', $HeadlineComposer['widget_data']['data']['headline_db']->image_lg, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter large image url here',
																'data-toggle'		=> ($errors->has('large_image') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('large_image') ? $errors->first('large_image') : ''), 
															]) 
						!!}
					</p>


					<p><img id='thumbnail_container' src="" class="img-responsive"></p>

				</div>

				<div class="well">
					<div class='title'>PUBLISH</div>
					<strong class='text-uppercase'>Active Since <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('active_since'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_since'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'active_since', ($HeadlineComposer['widget_data']['data']['headline_db']->active_since ? $HeadlineComposer['widget_data']['data']['headline_db']->active_since->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('active_since') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_since') ? $errors->first('active_since') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

					<div class="clearfix mt-sm"></div>

					<strong class='text-uppercase'>Active Until <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('active_until'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('active_until'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'active_until', ($HeadlineComposer['widget_data']['data']['headline_db']->active_until ? $HeadlineComposer['widget_data']['data']['headline_db']->active_until->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('active_until') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('active_until') ? $errors->first('active_until') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
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