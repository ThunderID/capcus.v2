@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "THIS VENDOR"}}
	@overwrite

	@section('widget_body')
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation">
				<a href="{{route('admin.vendor.show', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id])}}" class='text-black'>Detail <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation">
				<a href="{{route('admin.vendor.edit', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id])}}" class='text-black'>Edit <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation">
				<a href="{{route('admin.vendor.subscription', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id])}}" class='text-black'>Subscription <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
			<li role="presentation">
				<a href="{{route('admin.vendor.delete_confirmation', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id])}}" class='text-black'>Delete <i class='glyphicon glyphicon-menu-right pull-right text-xs pt-5'></i></a>
			</li>
		</ul>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif