<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Article:Full List';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Article"}}
	@overwrite

	@section('widget_body')
		@forelse ($articles as $k => $x)
			@if ($k)
				<hr class='border-dotted mb-sm'>
			@endif

			<div class='row mb-sm'>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<a href='{{ route("web.blog.show", ["year" => $x->published_at->year, "month" => $x->published_at->month, "slug" => $x->slug]) }}' class='text-black text-uppercase'>
						{!! HTML::image($x->thumbnail, $x->title, ['class' => 'img-responsive pull-left border-black border-1', 'data-src' => $x->thumbnail]) !!}
					</a>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<a href='{{ route("web.blog.show", ["year" => $x->published_at->year, "month" => $x->published_at->month, "slug" => $x->slug]) }} ' class='text-black text-uppercase text-md text-bold'>
						{{$x->title}}
					</a>

					<p class='text-light text-sm mt-5'>
						{{$x->published_at->diffForHumans()}} - By {{ $x->user->name }}
					</p>

					<p class='mt-sm'>{{ str_limit(strip_tags($x->content), 400) }} <a href='{{ route("web.blog.show", ["slug" => $x->slug]) }}'>Baca selengkapnya <i class='fa fa-chevron-right'></i></a>
				</div>
			</div>
		@empty
			No data found
		@endforelse
		<hr class='border-dotted mb-sm'>

		@if (method_exists($articles, 'lastPage'))
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					{!! $articles->render() !!}
				</div>
			</div>
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif