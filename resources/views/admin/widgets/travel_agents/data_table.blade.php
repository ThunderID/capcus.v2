<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['travel_agents'];
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
		@if (method_exists($travel_agents, 'total'))
			{{number_format($travel_agents->total())}} results :
		@else
			{{number_format($travel_agents->count())}} results :
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
					<th><span class="fa fa-sort-asc" aria-hidden="true"></span> Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($travel_agents as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($travel_agents, 'firstItem'))
								{{$travel_agents->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->email}}</td>
						<td>
							@forelse($x->phones as $phone)
								{{$phone}}<br>
							@empty
							@endforelse
						</td>
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
			@if ($travel_agents)
				@if (method_exists($travel_agents, 'firstItem'))
					@if ($travel_agents->total())
						Displaying {{ $travel_agents->total() > 0 ? $travel_agents->firstItem() . ' - ' . $travel_agents->lastItem() : 0 }} of {!! $travel_agents->total() !!} 
						<div>{!! $travel_agents->appends($filters)->render() !!}</div>
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