@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($CategoryComposer['widget_data']['data']['category_db']->id)
			Edit Article Category: {{$CategoryComposer['widget_data']['data']['category_db']->path_name}}
		@else
			Create new Article Category:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $CategoryComposer['widget_data']['data']['category_db']->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $CategoryComposer['widget_data']['data']['category_db']->name, [
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
						<strong class='text-uppercase'>Category</strong>
						@if ($errors->has('category'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('category'))}}</span>
						@endif
						{!! Form::select('parent_id', ['' => '-'] + $CategoryComposer['widget_data']['parent_category_list']['category_db']->lists('path_name', 'id'), $CategoryComposer['widget_data']['data']['category_db']->parent_id, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter category url here',
																'data-toggle'		=> ($errors->has('category') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('category') ? $errors->first('category') : ''), 
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