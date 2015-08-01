@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if ($TourComposer['widget_data']['data']['tour_db']->id)
			Edit Tour: {{$TourComposer['widget_data']['data']['tour_db']->name}}
		@else
			Create new Tour:
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $TourComposer['widget_data']['data']['tour_db']->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Name</strong>
						@if ($errors->has('name'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('name'))}}</span>
						@endif
						{!! Form::text('name', $TourComposer['widget_data']['data']['tour_db']->name, [
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
						@if ($TourComposer['widget_data']['data']['tour_db']->slug)
							<p>{{$TourComposer['widget_data']['data']['tour_db']->slug}}
						@else
							{!! Form::text('slug', $TourComposer['widget_data']['data']['tour_db']->slug, [
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
						<strong class='text-uppercase'>Vendor</strong>
						@if ($errors->has('vendor'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('vendor'))}}</span>
						@endif
						{!! Form::select('vendor', $VendorComposer['widget_data']['data']['vendor_db']->lists('name', 'id'), $VendorComposer['widget_data']['data']['vendor_db']->vendor_id, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter vendor url here',
																'data-toggle'		=> ($errors->has('vendor') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('vendor') ? $errors->first('vendor') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Summary </strong>
						@if ($errors->has('summary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('summary'))}}</span>
						@endif
						{!! Form::textarea('summary', $TourComposer['widget_data']['data']['tour_db']->summary, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter summary here',
																'data-toggle'		=> ($errors->has('summary') ? 'tooltip' : ''), 
																'data-placement'	=> 'bottom', 
																'title' 			=> ($errors->has('summary') ? $errors->first('summary') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Content </strong>
						@if ($errors->has('content'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('content'))}}</span>
						@endif
						<p><small class='text-primary'>To add an image/youtube video just copy & paste inside the content below and press enter</small>
						{!! Form::textarea('content', $TourComposer['widget_data']['data']['tour_db']->content, [
																'class' 			=> 'form-control wysiwyg', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter content here',
																'data-toggle' 		=> ($errors->has('content') ? 'tooltip' : ''), 
																'data-placement' 	=> 'right', 
																'title' 			=> ($errors->has('content') ? $errors->first('content') : ''),
																'data-height'		=> 1000 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Rundown </strong>
						@if ($errors->has('rundown'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('rundown'))}}</span>
						@endif
						<p><small class='text-primary'>Enter daily schedules</small>
						{!! Form::textarea('rundown', $TourComposer['widget_data']['data']['tour_db']->rundown, [
																'class' 			=> 'form-control wysiwyg', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter content here',
																'data-toggle' 		=> ($errors->has('rundown') ? 'tooltip' : ''), 
																'data-placement' 	=> 'right', 
																'title' 			=> ($errors->has('rundown') ? $errors->first('rundown') : ''),
																'data-height'		=> 1000 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Package Including </strong>
						@if ($errors->has('package_including'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('package_including'))}}</span>
						@endif
						<p><small class='text-primary'>One per line</small>
						{!! Form::textarea('package_including', $TourComposer['widget_data']['data']['tour_db']->package_including, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter what\'s included in the package here (one per line)',
																'data-toggle' 		=> ($errors->has('package_including') ? 'tooltip' : ''), 
																'data-placement' 	=> 'right', 
																'title' 			=> ($errors->has('package_including') ? $errors->first('package_including') : ''),
																'data-height'		=> 1000 
															]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Package Excluding </strong>
						@if ($errors->has('package_excluding'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('package_excluding'))}}</span>
						@endif
						<p><small class='text-primary'>One per line</small>
						{!! Form::textarea('package_excluding', $TourComposer['widget_data']['data']['tour_db']->package_excluding, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter what\'s not included in the package here (one per line)',
																'data-toggle' 		=> ($errors->has('package_excluding') ? 'tooltip' : ''), 
																'data-placement' 	=> 'right', 
																'title' 			=> ($errors->has('package_excluding') ? $errors->first('package_excluding') : ''),
																'data-height'		=> 1000 
															]) 
						!!}
					</div>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="well">
					<div class='title'>DURATION</div>
					<div class='mb-sm'>	
						<strong class='text-uppercase'>Day</strong>
						@if ($errors->has('day'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('day'))}}</span>
						@endif
						{!! Form::select('day', range(1,365), $TourComposer['widget_data']['data']['tour_db']->day, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter day url here',
																'data-toggle'		=> ($errors->has('day') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('day') ? $errors->first('day') : ''), 
															]) 
						!!}
					</div>

					<div class='mb-sm'>	
						<strong class='text-uppercase'>Night</strong>
						@if ($errors->has('night'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('night'))}}</span>
						@endif
						{!! Form::select('night', range(1,365), $TourComposer['widget_data']['data']['tour_db']->night, [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter night url here',
																'data-toggle'		=> ($errors->has('night') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('night') ? $errors->first('night') : ''), 
															]) 
						!!}
					</div>
				</div>

				<div class="well">
					<div class='title'>CATEGORIES</div>
					<p>	
						<strong class='text-uppercase'>Category</strong>
						@if ($errors->has('category'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('category'))}}</span>
						@endif
						{!! Form::select('category[]', $CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'id'), ($TourComposer['widget_data']['data']['tour_db'] ? $TourComposer['widget_data']['data']['tour_db']->categories->lists('id') : null), [
																'class' 			=> 'form-control select2', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter category url here',
																'data-toggle'		=> ($errors->has('category') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('category') ? $errors->first('category') : ''), 
																'multiple'			=> 'multiple'
															]) 
						!!}
					</p>
				</div>

				<div class="well">
					<div class='title'>SMALL THUMBNAIL</div>
					<p>	
						<strong class='text-uppercase'>Small Thumbnail URL</strong>
						@if ($errors->has('small_thumbnail'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('small_thumbnail'))}}</span>
						@endif
						{!! Form::text('small_thumbnail', $TourComposer['widget_data']['data']['tour_db']->thumbnail_sm, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter small thumbnail url here',
																'data-toggle'		=> ($errors->has('small_thumbnail') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('small_thumbnail') ? $errors->first('small_thumbnail') : ''), 
															]) 
						!!}
					</p>

					<p><img id='thumbnail_container' src="" class="img-responsive"></p>

					<p>	
						<strong class='text-uppercase'>Large Thumbnail URL</strong>
						@if ($errors->has('large_thumbnail'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('large_thumbnail'))}}</span>
						@endif
						{!! Form::text('large_thumbnail', $TourComposer['widget_data']['data']['tour_db']->thumbnail_lg, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter large thumbnail url here',
																'data-toggle'		=> ($errors->has('large_thumbnail') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('large_thumbnail') ? $errors->first('large_thumbnail') : ''), 
															]) 
						!!}
					</p>

					<p><img id='thumbnail_container' src="" class="img-responsive"></p>

				</div>

				<div class="well hidden-xs hidden-sm hidden-md">
					<div class='title'>PUBLISH</div>
					<strong class='text-uppercase'>Published At <small class='text-primary'>(dd/mm/yyyy hh:mm)</small></strong>
					@if ($errors->has('published_at'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('published_at'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'published_at', ($TourComposer['widget_data']['data']['tour_db']->published_at ? $TourComposer['widget_data']['data']['tour_db']->published_at->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'leave blank to save it as draft',
																						'data-toggle'		=> ($errors->has('published_at') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('published_at') ? $errors->first('published_at') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}

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