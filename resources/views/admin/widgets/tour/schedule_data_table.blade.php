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
					<th>Departure / Return</th>
					<th>Currency</th>
					<th class='text-right'>Price</th>
					<th class='text-right'>Discount</th>
					<th>Voucher Created</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($TourScheduleComposer['widget_data']['data']['tour_schedule_db'] as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($TourScheduleComposer['widget_data']['data']['tour_schedule_db'], 'firstItem'))
								{{$TourScheduleComposer['widget_data']['data']['tour_schedule_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->depart_at->format('d-m-Y H:i')}} / {{$x->return_at->format('d-m-Y H:i')}} </td>
						<td>{{$x->currency}}</td>
						<td class='text-right'>{{number_format($x->price)}}</td>
						<td class='text-right'>{{number_format($x->discount)}}</td>
						<td>{{$x->booked()->count()}}</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.tour.schedules", ["tour_id" => $TourScheduleComposer["widget_data"]["data"]["filter_tour_id"],"id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin.tour.schedules", ["tour_id" => $TourScheduleComposer["widget_data"]["data"]["filter_tour_id"],"id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
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
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif