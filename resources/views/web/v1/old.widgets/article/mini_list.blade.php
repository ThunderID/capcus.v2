<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			$widget_errors->add($x, '$'.$x.': has not been handled');
			$widget_error_count++;
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// MISC
	// ------------------------------------------------------------------------------------------------------------------------
?>

@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Article"}}
	@overwrite

	@section('widget_body')
		@forelse ($articles['result']['data'] as $k => $x)
			<div class='row mb-sm'>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<a href='{{ route("web.blog.show", ["year" => $x->published_at->year, "month" => $x->published_at->month, "slug" => $x->slug]) }}' class='text-black text-md text-uppercase'>
						{!! HTML::image($x->thumbnail, $x->title, ['class' => 'img-responsive pull-left border-black border-1', 'data-src' => $x->thumbnail]) !!}
					</a>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<a href='{{ route("web.blog.show", ["year" => $x->published_at->year, "month" => $x->published_at->month, "slug" => $x->slug]) }}' class='text-black text-uppercase'>
						{{$x->title}}
					</a>
				</div>
			</div>
		@empty
			No data found
		@endforelse
		<hr class='border-dotted mb-sm'>
		<div class='text-center'>
			<a href='{{route("web.blog")}}' class='btn btn-default'>READ MORE</a>
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif