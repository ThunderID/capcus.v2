<?php
	$filters = array_only($TourComposer['widget_data']['data'], ['filter_tour_name', 'filter_tour_vendor']);
	if ($TourComposer['widget_data']['data']['tour_db'])
	{
		$TourComposer['widget_data']['data']['tour_db']->load('vendor');
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if (!$widget_title)
			@if (method_exists($TourComposer['widget_data']['data']['tour_db'], 'total'))
				{{number_format($TourComposer['widget_data']['data']['tour_db']->total())}} results :
			@else
				{{number_format($TourComposer['widget_data']['data']['tour_db']->count())}} results :
			@endif

			@if (count(array_filter($filters)))

				@if ($TourComposer['widget_data']['data']['filter_category_name'])
					<a href='{{route("admin." . $route_name . ".index", array_except($filters, "filter_category_name"))}}' class="label label-primary ml-xs">
						<i class='glyphicon glyphicon-remove'></i> 
						Title: 
						{{$TourComposer['widget_data']['data']['filter_category_name'] . '*'}}
					</a>
				@endif

			@else
				all {{str_plural(str_replace('_', ' ', $view_name))}}
			@endif
		@else
			{{$widget_title}}
		@endif
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Vendor</th>
					<th>Destination</th>
					<th><span class="fa fa-sort-desc" aria-hidden="true"> </span> Published &amp; Created</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($TourComposer['widget_data']['data']['tour_db'] as $x)
					<tr class="text-regular {{!$x->published_at ? 'bg-warning' : ''}} ">
						<td>
							@if (method_exists($TourComposer['widget_data']['data']['tour_db'], 'firstItem'))
								{{$TourComposer['widget_data']['data']['tour_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->vendor->name}}</td>
						<td>
							@if ($x->categories->count())
								@foreach ($x->categories as $cat)
									<span class="label label-info mr-xs">{{$cat->path_name}}</span><br>
								@endforeach
							@endif
						</td>
						<td>
							P: {!! $x->published_at ? $x->published_at->diffForHumans() : '<span class="text-warning">draft</span>' !!}<br/>
							C: {!! $x->created_at->diffForHumans() !!}<br>
							U: {!! $x->updated_at->diffForHumans() !!}
						</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.tour.edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin.tour.show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan='8'>
							No data found
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		<hr>
		<div class="text-center">
			@if ($TourComposer['widget_data']['data']['tour_db'])
				@if (method_exists($TourComposer['widget_data']['data']['tour_db'], 'firstItem'))
					@if ($TourComposer['widget_data']['data']['tour_db']->total())
						Displaying {{ $TourComposer['widget_data']['data']['tour_db']->total() > 0 ? $TourComposer['widget_data']['data']['tour_db']->firstItem() . ' - ' . $TourComposer['widget_data']['data']['tour_db']->lastItem() : 0 }} of {!! $TourComposer['widget_data']['data']['tour_db']->total() !!} 
						<div>{!! $TourComposer['widget_data']['data']['tour_db']->appends($filters)->render() !!}</div>
					@else
						0 Results
					@endif
				@endif
			@endif
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif