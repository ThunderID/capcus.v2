@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Vendor Subscription"}}
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Subscription</th>
					<th>Since</th>
					<th>Until</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($VendorComposer['widget_data']['data']['vendor_db']->subscriptions->sortBy('since') as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($VendorComposer['widget_data']['data']['vendor_db'], 'firstItem'))
								{{$VendorComposer['widget_data']['data']['vendor_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->category->name}}</td>
						<td>{{$x->since->format('d-M-Y')}}</td>
						<td>{{$x->until->format('d-M-Y')}} </td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.vendor.subscription", ["vendor_id" => $VendorComposer["widget_data"]["data"]["vendor_db"]->id,"id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin.vendor.subscription", ["vendor_id" => $VendorComposer["widget_data"]["data"]["vendor_db"]->id,"id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
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