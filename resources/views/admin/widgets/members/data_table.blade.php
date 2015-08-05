<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['users', 'filters'];
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
		@if (method_exists($users, 'total'))
			{{number_format($users->total())}} results :
		@else
			{{number_format($users->count())}} results :
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
					<th>Email</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($users as $x)
					<tr>
						<td>
							@if (method_exists($users, 'firstItem'))
								{{$users->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->email}}</td>
						<td class='text-right'>
							<div class="btn-group">
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
			@if ($users)
				@if (method_exists($users, 'firstItem'))
					@if ($users->total())
						Displaying {{ $users->total() > 0 ? $users->firstItem() . ' - ' . $users->lastItem() : 0 }} of {!! $users->total() !!} 
						<div>{!! $users->appends($filters)->render() !!}</div>
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