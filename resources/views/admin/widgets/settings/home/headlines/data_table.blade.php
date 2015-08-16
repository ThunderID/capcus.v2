<?php

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['headlines'];
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
		Headlines
	@overwrite

	@section('widget_body')

		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Priority</th>
					<th>Link To</th>
					<th>Active</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@if ($headlines->count())
					@foreach ($headlines as $k => $x)
						<tr>
							<td>{{$k+1}}</td>
							<td>{{$x->title}}</td>
							<td>{{$x->priority}}</td>
							<td><a href="{{$x->link_to}}" target="_blank">{{$x->link_to}}</a></td>
							<td>
								<strong>{{$x->active_since->format('d-m-Y (H:i)')}}</strong> to <strong>{{$x->active_until->format('d-m-Y (H:i)')}}</strong>
								<br>{{ $x->active_since->diffInDays($x->active_until)}} days
							</td>
							<td>
								<a href="{{ route('admin.'.$route_name.'.headlines.edit', ['id' => $x->id])}} " class="btn btn-link">Edit</a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan=6>
							There is no headline. To add headline <a href="{{ route('admin.'.$route_name.'.headlines.create') }}">click here</a>
						</td>
					</tr>
				@endif
			</tbody>
		</table>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif