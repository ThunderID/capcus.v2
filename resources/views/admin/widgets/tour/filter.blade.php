@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or 'Filter Tour'}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $TourComposer['widget_data']['data']['form_url'], 'method' => 'get', 'class' => 'form']) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Search</small>
				{!! Form::text('filter_tour_name', $TourComposer['widget_data']['data']['filter_tour_name'], ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Vendor</small>
				{!! Form::select('filter_tour_vendor', ['' => 'All Vendors'] + $VendorComposer['widget_data']['data']['vendor_db']->lists('name', 'id'), $VendorComposer['widget_data']['data']['filter_tour_vendor'], ['class' => 'form-control select2', 'placeholder' => 'Search...']) !!}
			</div>
			{{-- SEARCH BUTTON --}}
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-sm text-center">
				<button type='submit' class='btn btn-info btn-block'><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</div>
		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif