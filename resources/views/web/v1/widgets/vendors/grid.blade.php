<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	$widget_errors 	= new \Illuminate\Support\MessageBag;
	$widget_name	= 'Vendor:Supported By';

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['vendors'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Vendors"}}
	@overwrite

	@section('widget_body')
		<div class="row">
			@forelse ($vendors as $k => $x)
				<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 text-center">
					<a href='{{route("web.tour", ["vendor" => $x->slug])}}' class='text-black' title="Klik untuk melihat paket tour dari {{$x->name}}">
						<img src='{{$x->logo_sm}}' data-src='{{$x->logo_sm}}' class='img-responsive desaturate'>
					</a>
				</div>
			@empty
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						Tidak ditemukan vendor di kategori ini
					</div>
				</div>
			@endforelse
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif
