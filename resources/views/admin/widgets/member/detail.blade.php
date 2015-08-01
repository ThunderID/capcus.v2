@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or 'ABOUT'}}
	@overwrite

	@section('widget_body')
		<section>
			<p class='text-regular'><span class="fa fa-envelope-o mr-xs" aria-hidden="true"></span> {{$UserComposer['widget_data']['data']['user_db']->email}}
			<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> C: {!! $UserComposer['widget_data']['data']['user_db']->created_at->format('d M Y [H:i]') !!}
			<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> U: {!! $UserComposer['widget_data']['data']['user_db']->updated_at->format('d M Y [H:i]') !!}
		</section>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif