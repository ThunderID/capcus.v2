<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Blog:DataTable';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['articles', 'filter_title', 'filter_writer', 'filter_status'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@section('widget_title')
	{{$widget_title or $ArticleComposer['widget_data']['data']['article_db']->title . ": Delete Confirmation "}}
@overwrite

@section('widget_body')
	{!! Form::open(['url' => route('admin.'.$route_name.'.delete', ['id' => $ArticleComposer['widget_data']['data']['article_db']->id]), 'method' => 'post', 'class' => 'form']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<p>Are you sure to delete this {{$route_name}} <strong>"{{$data->title}}"</strong>?</p>
			<p>
				<a href="{{route('admin.'. $route_name . '.show', ['id' => $ArticleComposer['widget_data']['data']['article_db']->id])}}" class='btn btn-default'> Cancel </a>
				<button class='btn btn-danger' type='submit'> Confirm </button>
			</p>
		</div>
	</div>
	{!! Form::close() !!}
@overwrite