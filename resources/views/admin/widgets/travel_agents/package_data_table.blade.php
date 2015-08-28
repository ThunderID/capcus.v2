<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['travel_agent'];
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
		{{$widget_title or "Tour Schedules"}}
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Active</th>
					<th>Package</th>
					<th>Quota Headline</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($travel_agent->packages as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($x, 'firstItem'))
								{{$x->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{\Carbon\Carbon::parse($x->pivot->active_since)->format('d-M-Y')}} s/d {{\Carbon\Carbon::parse($x->pivot->active_until)->format('d-M-Y')}}</td>
						<td>{{$x->name}}</td>
						<td class='text-right'>{{number_format($x->quota_headline)}}</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.".$view_name.".package", ["travel_agent" => $travel_agent->id,"id" => $x->id])}}' type="button" class="btn btn-default"><span class="fa fa-pencil-square-o"></a>
								{{-- <a href='{{route("admin.".$view_name.".package.delete", ["tour_id" => $tour->id,"id" => $x->id])}}' type="button" class="btn btn-default btn_delete_schedule" ><span class="glyphicon glyphicon-remove"></a> --}}
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
	@overwrite

	@section('js')
		@parent
		<script>
			$('.btn_delete_schedule').click(function(event) {
				/* Act on the event */
				if (!confirm('Are you sure to delete this schedule?'))
				{
					event.preventDefault();
				}
			});
		</script>
	@stop
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif