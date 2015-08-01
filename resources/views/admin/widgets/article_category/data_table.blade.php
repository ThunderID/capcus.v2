<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'ArticleCategory:DataTable';

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

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if (method_exists($categories, 'total'))
			{{number_format($categories->total())}} results :
		@else
			{{number_format($categories->count())}} results :
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
					<th><span class="fa fa-sort-asc" aria-hidden="true">Path</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($categories as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($categories, 'firstItem'))
								{{$categories->firstItem() + $i++}}
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
			@if ($categories)
				@if (method_exists($categories, 'firstItem'))
					@if ($categories->total())
						Displaying {{ $categories->total() > 0 ? $categories->firstItem() . ' - ' . $categories->lastItem() : 0 }} of {!! $categories->total() !!} 
						<div>{!! $categories->appends($filters)->render() !!}</div>
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