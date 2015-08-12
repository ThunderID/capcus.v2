@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or 'Filter'}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $widget_data['form_url'], 'method' => 'get', 'class' => 'form']) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Search</small>
				{!! Form::text('filter_vendor_title', Input::get('filter_vendor_title'), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Category</small>
				<br/>{!! Form::select('filter_vendor_category', ['' => 'All'] + ($CategoryComposer['widget_data']['data']['category_db'] ? $CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'id') : []), Input::get('filter_vendor_category'), ['class' => 'form-control select2', 'placeholder' => 'Search...']) !!}
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