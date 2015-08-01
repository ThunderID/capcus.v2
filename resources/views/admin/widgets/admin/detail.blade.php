@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or $UserComposer['widget_data']['data']['user_db']->name}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<section>
					<h4 class='text-primary'>ABOUT</h4>
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> C: {!! $UserComposer['widget_data']['data']['user_db']->created_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> U: {!! $UserComposer['widget_data']['data']['user_db']->updated_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> P: {!! $UserComposer['widget_data']['data']['user_db']->published_at ? $UserComposer['widget_data']['data']['user_db']->published_at->format('d M Y [H:i]') . ' <span class="text-primary">[' . $UserComposer['widget_data']['data']['user_db']->published_at->diffForHumans() . ']</span>' : 'draft' !!}
				</section>
			</div>
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif