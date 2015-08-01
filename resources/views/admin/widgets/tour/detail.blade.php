@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or $TourComposer['widget_data']['data']['tour_db']->name . " by " . $TourComposer['widget_data']['data']['tour_db']->vendor->name}}
	@overwrite

	@section('widget_body')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<section>
					<h4 class='text-primary'>SMALL THUMBNAIL</h4>
					@if ($TourComposer['widget_data']['data']['tour_db']->thumbnail_sm)
						{!! HTML::image($TourComposer['widget_data']['data']['tour_db']->thumbnail_sm, $TourComposer['widget_data']['data']['tour_db']->title, ['class' => 'img-responsive mb-sm']) !!}
					@else
						<i>No thumbnail</i>
					@endif

					<h4 class='text-primary'>LARGE THUMBNAIL</h4>
					@if ($TourComposer['widget_data']['data']['tour_db']->thumbnail_lg)
						{!! HTML::image($TourComposer['widget_data']['data']['tour_db']->thumbnail_lg, $TourComposer['widget_data']['data']['tour_db']->title, ['class' => 'img-responsive mb-sm']) !!}
					@else
						<i>No thumbnail</i>
					@endif
				</section>
				<hr>
				<section>
					<h4 class='text-primary'>ABOUT</h4>
					<p class='text-regular'><span class="fa fa-tags mr-xs" aria-hidden="true"></span>{{implode(', ', $TourComposer['widget_data']['data']['tour_db']->categories()->lists('path_name'))}}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> C: {!! $TourComposer['widget_data']['data']['tour_db']->created_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> U: {!! $TourComposer['widget_data']['data']['tour_db']->updated_at->format('d M Y [H:i]') !!}
					<p class='text-regular'><span class="fa fa-calendar mr-xs" aria-hidden="true"></span> P: {!! $TourComposer['widget_data']['data']['tour_db']->published_at ? $TourComposer['widget_data']['data']['tour_db']->published_at->format('d M Y [H:i]') . ' <span class="text-primary">[' . $TourComposer['widget_data']['data']['tour_db']->published_at->diffForHumans() . ']</span>' : 'draft' !!}
				</section>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<article>
					<h4 class='text-primary'>SUMMARY</h4>
					<blockquote class='text-regular'>
						{{ $TourComposer['widget_data']['data']['tour_db']->summary }}
					</blockquote>

					<h4 class='text-primary'>CONTENT</h4>
					{!! $TourComposer['widget_data']['data']['tour_db']->content !!}
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