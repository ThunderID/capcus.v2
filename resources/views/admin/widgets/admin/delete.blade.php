@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@section('widget_title')
	{{$widget_title or $UserComposer['widget_data']['data']['user_db']->name }} : Delete Confirmation 
@overwrite

@section('widget_body')
	{!! Form::open(['url' => route('admin.'.$route_name.'.delete', ['id' => $UserComposer['widget_data']['data']['user_db']->id]), 'method' => 'post', 'class' => 'form']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<p>Are you sure to delete this {{str_replace('_', ' ', $route_name)}} <strong>"{{$UserComposer['widget_data']['data']['user_db']->name}}"</strong>?</p>
			<p>
				<a href="{{route('admin.'. $route_name . '.show', ['id' => $UserComposer['widget_data']['data']['user_db']->id])}}" class='btn btn-default'> Cancel </a>
				<button class='btn btn-danger' type='submit'> Confirm </button>
			</p>
		</div>
	</div>
	{!! Form::close() !!}
@overwrite