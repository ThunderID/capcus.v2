@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or 'Filter Category'}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['url' => $CategoryComposer['widget_data']['data']['form_url'], 'method' => 'get', 'class' => 'form']) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-xs">
				<small>Search</small>
				{!! Form::text('filter_category_name', $CategoryComposer['widget_data']['data']['filter_category_name'], ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
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