<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['places'];
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
		@if (method_exists($places, 'total'))
			{{number_format($places->total())}} results :
		@else
			{{number_format($places->count())}} results :
		@endif

		@if (count(array_filter($filters)))
			@foreach ($filters as $k => $v)
				@if ($v)
					<a href='{{route("admin." . $route_name . ".index", array_except($filters, $k))}}' class="label label-primary ml-xs">
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
					<th>Name</th>
					<th>Location</th>
					<th><span class="fa fa-sort-desc" aria-hidden="true"></span> Created At</th>
					<th>Published At</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($places as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($places, 'firstItem'))
								{{$places->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->long_name}}</td>
						<td>{{$x->destination->path}}</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin." . $route_name . ".edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="fa fa-pencil-square-o"></a>
								<a href='{{route("admin." . $route_name . ".show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="fa fa-info-circle"></a>
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
			@if ($destinations)
				@if (method_exists($destinations, 'firstItem'))
					@if ($destinations->total())
						Displaying {{ $destinations->total() > 0 ? $destinations->firstItem() . ' - ' . $destinations->lastItem() : 0 }} of {!! $destinations->total() !!} 
						<div>{!! $destinations->appends($filters)->render() !!}</div>
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