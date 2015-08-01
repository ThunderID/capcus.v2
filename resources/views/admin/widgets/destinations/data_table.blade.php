<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['destinations'];
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
		@if (method_exists($destinations, 'total'))
			{{number_format($destinations->total())}} results :
		@else
			{{number_format($destinations->count())}} results :
		@endif

		@if (count(array_filter($filters)))
			@foreach ($filters as $k => $v)
				<a href='{{route("admin." . $route_name . ".index", array_except($filters, $k))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					{{$k}}: {{$v}}
				</a>
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
					<th><span class="fa fa-sort-asc" aria-hidden="true"> Destination</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($destinations as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($destinations, 'firstItem'))
								{{$destinations->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>
							<?php
								$tmp = explode($x->getDelimiter() , $x->ori_path);
							?>
							@foreach ($tmp as $k => $region)
								@if ($k != count($tmp) - 1)
									{{$region}} &gt;
								@else
									<span class='text-primary text-bold'>{{$x->name}}</span>
								@endif
							@endforeach
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