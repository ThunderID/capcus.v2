@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Article"}}
	@overwrite

	@section('widget_body')
		@forelse ($ArticleComposer['widget_data']['data']['article_db'] as $k => $x)
			<div class='row mb-sm'>
				@if ($k)
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-5 mb-md">
						<hr class='border-light border-dotted '>
					</div>
				@endif 

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<a href='{{ route("web.blog.show", ["year" => $x->published_at->year, "month" => $x->published_at->month, "slug" => $x->slug]) }}' class='text-black text-md text-uppercase'>
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
		<hr class='border-dotted border-light mb-sm'>
		<div class='text-center'>
			{{ $ArticleComposer['widget_data']['data']['article_db']->render() }}
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif