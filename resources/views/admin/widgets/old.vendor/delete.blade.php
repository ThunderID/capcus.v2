@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@section('widget_title')
	{{$widget_title or $VendorComposer['widget_data']['data']['vendor_db']->name . ": Delete Confirmation "}}
@overwrite

@section('widget_body')
	{!! Form::open(['url' => route('admin.vendor.delete', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id]), 'method' => 'post', 'class' => 'form']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<p>Are you sure to delete this {{$route_name}} <strong>"{{$data->name}}"</strong>?</p>
			<p>
				<a href="{{route('admin.'. $route_name . '.show', ['id' => $VendorComposer['widget_data']['data']['vendor_db']->id])}}" class='btn btn-default'> Cancel </a>
				<button class='btn btn-danger' type='submit'> Confirm </button>
			</p>
		</div>
	</div>
	{!! Form::close() !!}
@overwrite