<?php 
	$filters = array_only($CategoryComposer['widget_data']['data'], ['filter_category_name']);
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if (method_exists($CategoryComposer['widget_data']['data']['category_db'], 'total'))
			{{number_format($CategoryComposer['widget_data']['data']['category_db']->total())}} results :
		@else
			{{number_format($CategoryComposer['widget_data']['data']['category_db']->count())}} results :
		@endif

		@if (count(array_filter($filters)))

			@if ($CategoryComposer['widget_data']['data']['filter_category_name'])
				<a href='{{route("admin." . $route_name . ".index", array_except($filters, "filter_category_name"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Title: 
					{{$CategoryComposer['widget_data']['data']['filter_category_name'] . '*'}}
				</a>
			@endif

		@else
			all {{str_plural(str_replace('_', ' ', $view_name))}}
		@endif
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th><span class="fa fa-sort-asc" aria-hidden="true"> Path</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($CategoryComposer['widget_data']['data']['category_db'] as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($CategoryComposer['widget_data']['data']['category_db'], 'firstItem'))
								{{$CategoryComposer['widget_data']['data']['category_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->path_name}}</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin." . $route_name . ".edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin." . $route_name . ".show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
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
			@if ($CategoryComposer['widget_data']['data']['category_db'])
				@if (method_exists($CategoryComposer['widget_data']['data']['category_db'], 'firstItem'))
					@if ($CategoryComposer['widget_data']['data']['category_db']->total())
						Displaying {{ $CategoryComposer['widget_data']['data']['category_db']->total() > 0 ? $CategoryComposer['widget_data']['data']['category_db']->firstItem() . ' - ' . $CategoryComposer['widget_data']['data']['category_db']->lastItem() : 0 }} of {!! $CategoryComposer['widget_data']['data']['category_db']->total() !!} 
						<div>{!! $CategoryComposer['widget_data']['data']['category_db']->appends($filters)->render() !!}</div>
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