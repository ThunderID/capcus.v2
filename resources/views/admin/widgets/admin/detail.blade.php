<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['user'];
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
		{{$widget_title or $user->title}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<section>
					<h4 class='text-primary'>THUMBNAIL</h4>
					@if ($user->thumbnail)
						{!! Html::image($user->thumbnail, $user->title, ['class' => 'img-responsive mb-sm']) !!}
					@else
						<i>No thumbnail</i>
					@endif
				</section>
				<hr>
				<section>
					<h4 class='text-primary'>ABOUT</h4>
					<p class='text-regular'><span class="fa fa-user mr-xs" aria-hidden="true"></span> {{$user->user->name}}
					<p class='text-regular'><span class="fa fa-tags mr-xs" aria-hidden="true"></span>{{implode(', ', $user->destinations->lists('path'))}}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> C: {!! $user->created_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> U: {!! $user->updated_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> P: {!! $user->published_at ? $user->published_at->format('d M Y [H:i]') . ' <span class="text-primary">[' . $user->published_at->diffForHumans() . ']</span>' : 'draft' !!}
				</section>
				<hr>
				<section>
					<h4 class='text-primary'>SUBARTICLES</h4>
					<?php $i = 0; ?>
					@forelse ($user->children as $child)	
						<p>[{{++$i}}]. <a href='{{route("admin.".$route_name.".show", ["id" => $child->id])}}'>{{$child->title}}</a>
					@empty
						<i>none</i>
					@endforelse
				</section>

				<hr>
				<section>
					<h4 class='text-primary'>SUBARTICLES OF</h4>
					<?php $i = 0; ?>
					@forelse ($user->parent as $parent)	
						<p>[{{++$i}}]. <a href='{{route("admin.".$route_name.".show", ["id" => $parent->id])}}'>{{$parent->title}}</a>
					@empty
						<i>none</i>
					@endforelse
				</section>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<article>
					<h4 class='text-primary'>SUMMARY</h4>
					<blockquote class='text-regular'>
						{{ $user->summary }}
					</blockquote>

					<h4 class='text-primary'>CONTENT</h4>
					{!! $user->content !!}
				</article>
			</div>

		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif