<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tours', 'filters'];
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
		@if (method_exists($tours, 'total'))
			{{number_format($tours->total())}} results :
		@else
			{{number_format($tours->count())}} results :
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
					<th><span class="fa fa-sort-asc" aria-hidden="true"></span> Tour</th>
					<th>Destination</th>
					<th>Options</th>
					<th>Schedules</th>
					<th><span class="fa fa-sort-desc" aria-hidden="true"> </span> P&amp;C</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($tours as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($tours, 'firstItem'))
								{{$tours->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>
							<strong>{{$x->name}}</strong>
							<br>Duration: {{$x->duration_day}}D/{{$x->duration_night}}N
							<br>By: {{$x->travel_agent->name}}</td>
						</td>
						<td width='45%'>
							<strong>{{implode(', ', $x->destinations->lists('path')->toArray())}} </strong>
							<br>
							{{implode(', ', $x->places->lists('name')->toArray())}} 
							<br>
							@foreach ($x->tags as $v)
								<span class="label label-success mr-ms">#{{$v->tag}}</span>
							@endforeach
						</td>
						<td>
							@forelse ($x->options as $k => $option)
								<p>
									<strong>{{$option->name}}</strong>
									<br>{{$x->options[$k]->pivot->description}}
								</p>
							@empty
							@endforelse
						</td>
						<td>
							@forelse ($x->schedules->sortby('departure') as $k => $schedule)
								{{$schedule->departure->format('d-m-Y')}}<br>
							@empty
							@endforelse
						</td>
						<td>
							P: {!! $x->published_at->year > 0 ? $x->published_at->diffForHumans() : '<span class="text-warning">draft</span>' !!}<br/>
							C: {!! $x->created_at->diffForHumans() !!}
						</td>
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
			@if ($tours)
				@if (method_exists($tours, 'firstItem'))
					@if ($tours->total())
						Displaying {{ $tours->total() > 0 ? $tours->firstItem() . ' - ' . $tours->lastItem() : 0 }} of {!! $tours->total() !!} 
						<div>{!! $tours->appends($filters)->render() !!}</div>
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