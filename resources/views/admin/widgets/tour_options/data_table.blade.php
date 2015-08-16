<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tour_options', 'filters'];
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
		@if (method_exists($tour_options, 'total'))
			{{number_format($tour_options->total())}} results :
		@else
			{{number_format($tour_options->count())}} results :
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
					<th><span class="fa fa-sort-asc" aria-hidden="true"> </span> Name</th>
					<th># of tours</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($tour_options as $x)
					<tr>
						<td>
							@if (method_exists($tour_options, 'firstItem'))
								{{$tour_options->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->tours->count()}}
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.".$route_name.".edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="fa fa-pencil-square-o"></a>
								<a href='{{route("admin.".$route_name.".show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="fa fa-info-circle"></a>
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
			@if ($tour_options)
				@if (method_exists($tour_options, 'firstItem'))
					@if ($tour_options->total())
						Displaying {{ $tour_options->total() > 0 ? $tour_options->firstItem() . ' - ' . $tour_options->lastItem() : 0 }} of {!! $tour_options->total() !!} 
						<div>{!! $tour_options->appends($filters)->render() !!}</div>
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