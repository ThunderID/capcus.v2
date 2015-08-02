<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles', 'filters'];
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
			@foreach ($filters as $k => $v)
				@if ($v)
					<a href='{{route("admin.".$route_name.".index", array_except($filters, $k))}}' class="label label-primary ml-xs">
						<i class='glyphicon glyphicon-remove'></i> 
						{{$k}}: {{$v}}
					</a>
				@endif
			@endforeach 
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
					<th>Related Destinations</th>
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
							@if ($x->destinations->count())
								@foreach ($x->destinations as $destination)
									<span class="label label-info mr-xs">{{$destination->path}}</span><br>
								@endforeach
							@endif
						</td>
						<td>{{$x->writer->name}}</td>
						<td>
							P: {!! $x->published_at->year > 0 ? $x->published_at->diffForHumans() : '<span class="text-warning">draft</span>' !!}<br/>
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