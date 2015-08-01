<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Blog:DataTable';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles', 'filter_title', 'filter_writer', 'filter_status'];
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
		@if (method_exists($articles, 'total'))
			{{number_format($articles->total())}} results :
		@else
			{{number_format($articles->count())}} results :
		@endif

		@if (count(array_filter($filters)))

			@if ($filter_title)
				<a href='{{route("admin.".$route_name.".index", array_except($filters, "filter_article_title"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Title: 
					{{'*'. $filter_title . '*'}}
				</a>
			@endif

			@if ($filter_writer)
				<a href='{{route("admin.".$route_name.".index", array_except($filters, "filter_article_user"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Writer: 
					{{$filter_writer}}
				</a>
			@endif

			@if ($filter_status)
				<a href='{{route("admin.".$route_name.".index", array_except($filters, "filter_article_status"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Status: 
					{{$filter_status}}
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
					<th>Title</th>
					<th>Category</th>
					<th>By</th>
					<th><span class="fa fa-sort-desc" aria-hidden="true"> </span> Published &amp; Created</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($articles as $x)
					<tr class="{{!$x->published_at ? 'bg-warning' : ''}} text-regular">
						<td>
							@if (method_exists($articles, 'firstItem'))
								{{$articles->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->title}}</td>
						<td>
							@if ($x->categories->count())
								@foreach ($x->categories as $cat)
									<span class="label label-info mr-xs">{{$cat->path_name}}</span><br>
								@endforeach
							@endif
						</td>
						<td>{{$x->user->name}}</td>
						<td>
							P: {!! $x->published_at ? $x->published_at->diffForHumans() : '<span class="text-warning">draft</span>' !!}<br/>
							C: {!! $x->created_at->diffForHumans() !!}
						</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.".$route_name.".edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin.".$route_name.".show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan='6'>
							No data found
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		<hr>
		<div class="text-center">
			@if ($articles)
				@if (method_exists($articles, 'firstItem'))
					@if ($articles->total())
						Displaying {{ $articles->total() > 0 ? $articles->firstItem() . ' - ' . $articles->lastItem() : 0 }} of {!! $articles->total() !!} 
						<div>{!! $articles->appends($filters)->render() !!}</div>
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