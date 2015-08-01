@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "ABOUT"}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>
					<strong>Active Since</strong>
					<br/>{{$HeadlineComposer['widget_data']['data']['headline_db']->active_since->format('d-M-Y [H:i]')}}
				</p>

				<p>
					<strong>Active Until</strong>
					<br/>{{$HeadlineComposer['widget_data']['data']['headline_db']->active_until->format('d-M-Y [H:i]')}}
				</p>

				<p>
					<strong>Vendor</strong>
					<br/>{{$HeadlineComposer['widget_data']['data']['headline_db']->vendor->name or "-"}}
				</p>

				<p>
					<strong>Small Image</strong>
					<br>{!! HTML::image($HeadlineComposer['widget_data']['data']['headline_db']->image_sm, 'small image', ['class' => 'img-thumbnail']) !!}
				</p>

				<p>
					<strong>Large Image</strong>
					<br>{!! HTML::image($HeadlineComposer['widget_data']['data']['headline_db']->image_lg, 'large image', ['class' => 'img-thumbnail']) !!}
				</p>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>
					<strong>Link To</strong>
					<br><iframe src="{{ $HeadlineComposer['widget_data']['data']['headline_db']->link_to }}" width="100%" height="800"></iframe>
				</p>
			</div>
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif