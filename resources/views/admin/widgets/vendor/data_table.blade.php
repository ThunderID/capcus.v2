<?php 
	$filters = array_only($VendorComposer['widget_data']['data'], ['filter_vendor_name', 'filter_vendor_category']);
	
	$VendorComposer['widget_data']['data']['vendor_db']->load('active_subscription', 'active_subscription.category');
?>


@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if (method_exists($VendorComposer['widget_data']['data']['vendor_db'], 'total'))
			{{number_format($VendorComposer['widget_data']['data']['vendor_db']->total())}} results :
		@else
			{{number_format($VendorComposer['widget_data']['data']['vendor_db']->count())}} results :
		@endif

		@if (count(array_filter($filters)))

			@if ($VendorComposer['widget_data']['data']['filter_vendor_name'])
				<a href='{{route("admin.vendor.index", array_except($filters, "filter_vendor_name"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Title: 
					{{$VendorComposer['widget_data']['data']['filter_vendor_name'] . '*'}}
				</a>
			@endif

			@if ($CategoryComposer['widget_data']['data']['filter_vendor_category'])
				<a href='{{route("admin.vendor.index", array_except($filters, "filter_vendor_category"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Category: 
					{{$CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'id')[$CategoryComposer['widget_data']['data']['filter_vendor_category']]}}
				</a>
			@endif

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
					<th>Subscription</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($VendorComposer['widget_data']['data']['vendor_db'] as $x)
					<tr class="text-regular">
						<td>
							@if (method_exists($VendorComposer['widget_data']['data']['vendor_db'], 'firstItem'))
								{{$VendorComposer['widget_data']['data']['vendor_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>
							@if ($x->active_subscription)
								<strong>{{$x->active_subscription->category->path_name}}</strong> ({{$x->active_subscription->since->format('d-M-Y')}} - {{$x->active_subscription->until->format('d-M-Y')}})
							@else
								<i>-</i>
							@endif
						</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.vendor.edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
								<a href='{{route("admin.vendor.show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
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
			@if ($VendorComposer['widget_data']['data']['vendor_db'])
				@if (method_exists($VendorComposer['widget_data']['data']['vendor_db'], 'firstItem'))
					@if ($VendorComposer['widget_data']['data']['vendor_db']->total())
						Displaying {{ $VendorComposer['widget_data']['data']['vendor_db']->total() > 0 ? $VendorComposer['widget_data']['data']['vendor_db']->firstItem() . ' - ' . $VendorComposer['widget_data']['data']['vendor_db']->lastItem() : 0 }} of {!! $VendorComposer['widget_data']['data']['vendor_db']->total() !!} 
						<div>{!! $VendorComposer['widget_data']['data']['vendor_db']->appends($filters)->render() !!}</div>
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