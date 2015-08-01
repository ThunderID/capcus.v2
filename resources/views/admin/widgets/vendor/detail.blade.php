@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or $VendorComposer['widget_data']['data']['vendor_db']->name}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<section>
					<h4 class='text-primary'>LOGO</h4>
					<p><strong>Small Logo</strong></p>
					@if ($VendorComposer['widget_data']['data']['vendor_db']->logo_sm)
						{!! Html::image($VendorComposer['widget_data']['data']['vendor_db']->logo_sm, $VendorComposer['widget_data']['data']['vendor_db']->title, ['class' => 'img-responsive mb-sm']) !!}
					@else
						<i>No Small Logo</i>
					@endif

					<p><strong>Large Logo</strong></p>
					@if ($VendorComposer['widget_data']['data']['vendor_db']->logo_lg)
						{!! Html::image($VendorComposer['widget_data']['data']['vendor_db']->logo_lg, $VendorComposer['widget_data']['data']['vendor_db']->title, ['class' => 'img-responsive mb-sm']) !!}
					@else
						<i>No Large Logo</i>
					@endif
				</section>
				<hr>
				<section>
					<h4 class='text-primary'>INFO</h4>
					<p class='text-regular'><span class="fa fa-tags mr-xs" aria-hidden="true"></span>
						{{$VendorComposer['widget_data']['data']['vendor_db']->active_subscription->category->name}}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> C: {!! $VendorComposer['widget_data']['data']['vendor_db']->created_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> U: {!! $VendorComposer['widget_data']['data']['vendor_db']->updated_at->format('d M Y [H:i]') !!}
				</section>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<article>
					<h4 class='text-primary'>ABOUT</h4>
					{!! $VendorComposer['widget_data']['data']['vendor_db']->summary !!}
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