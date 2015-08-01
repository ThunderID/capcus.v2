<?php
	$subarticle_list = [];
	if ($ArticleComposer['widget_data']['data']['article_db'])
	{
		foreach ($ArticleComposer['widget_data']['data']['article_db']->children as $child)
		{
			$subarticle_list[] = ['id' => $child->id, 'title' => $child->title, 'order' => $child->pivot->order];
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Blog:DataTable';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles', 'filter_title', 'filter_writer', 'filter_status'];
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
		@if ($ArticleComposer['widget_data']['data']['article_db']->id)
			Edit Article: {{$ArticleComposer['widget_data']['data']['article_db']->title}}
		@else
			Create new article: {{$article_type}}
		@endif
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.'.$route_name.'.store', ['id' => $ArticleComposer['widget_data']['data']['article_db']->id]), 'class' => 'no_enter']) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
				<div class="well">
					<div class='title'>Basic Information</div>
					<div class='mb-sm'>
						<strong class='text-uppercase'>Title</strong>
						@if ($errors->has('title'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('title'))}}</span>
						@endif
						{!! Form::text('title', $ArticleComposer['widget_data']['data']['article_db']->title, [
																'class' 			=> 'form-control', 
																'placeholder' 		=> 'enter title here', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('title') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('title') ? $errors->first('title') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Slug <small class='text-primary'>(URL)</small> </strong>
						@if ($errors->has('slug'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('slug'))}}</span>
						@endif
						@if ($ArticleComposer['widget_data']['data']['article_db']->slug)
							<p>{{$ArticleComposer['widget_data']['data']['article_db']->slug}}
						@else
							{!! Form::text('slug', $ArticleComposer['widget_data']['data']['article_db']->slug, [
																	'class' 			=> 'form-control slugify', 
																	'placeholder' 		=> 'enter slug here', 
																	'required' 			=> 'required',
																	'data-toggle' 		=> ($errors->has('slug') ? 'tooltip' : ''), 
																	'data-placement' 	=> 'bottom', 
																	'title' 			=> ($errors->has('slug') ? $errors->first('slug') : ''), 
																	'data-slugify'		=> 'title'
																]) 
							!!}
						@endif
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Summary </strong>
						@if ($errors->has('summary'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('summary'))}}</span>
						@endif
						{!! Form::textarea('summary', $ArticleComposer['widget_data']['data']['article_db']->summary, [
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
						{!! Form::textarea('content', $ArticleComposer['widget_data']['data']['article_db']->content, [
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
						<strong class='text-uppercase'>Subarticle</strong>
						@if ($errors->has('subarticle'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('subarticle'))}}</span>
						@endif

 						{!! Form::select('subarticle[]', ($ArticleComposer['widget_data']['data']['article_db']->children ? $ArticleComposer['widget_data']['data']['article_db']->children->lists('title', 'id') : []), ($ArticleComposer['widget_data']['data']['article_db'] ? $ArticleComposer['widget_data']['data']['article_db']->children->lists('id') : null), [
																'class' 			=> 'form-control select2-article subarticle-dropdown', 
																'required' 			=> 'required',
																'data-toggle'		=> ($errors->has('subarticle') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('subarticle') ? $errors->first('subarticle') : ''), 
																'multiple'			=> 'multiple'
															]) 
						!!}
 					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="well">
					<div class='title'>CATEGORIES</div>
					<p>	
						<strong class='text-uppercase'>Category</strong>
						@if ($errors->has('category'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('category'))}}</span>
						@endif
						{!! Form::select('category[]', $CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'id'), ($ArticleComposer['widget_data']['data']['article_db'] ? $ArticleComposer['widget_data']['data']['article_db']->categories->lists('id') : null), [
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
					<div class='title'>THUMBNAIL</div>
					<p>	
						<strong class='text-uppercase'>Thumbnail URL</strong>
						@if ($errors->has('thumbnail'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('thumbnail'))}}</span>
						@endif
						{!! Form::text('thumbnail', $ArticleComposer['widget_data']['data']['article_db']->thumbnail, [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'placeholder' 		=> 'enter thumbnail url here',
																'data-toggle'		=> ($errors->has('thumbnail') ? 'tooltip' : ''), 
																'data-placement'	=> 'left', 
																'title' 			=> ($errors->has('thumbnail') ? $errors->first('thumbnail') : ''), 
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
					{!! Form::input('datetime-local', 'published_at', ($ArticleComposer['widget_data']['data']['article_db']->published_at ? $ArticleComposer['widget_data']['data']['article_db']->published_at->format('d/m/Y H:i') : ''), [
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