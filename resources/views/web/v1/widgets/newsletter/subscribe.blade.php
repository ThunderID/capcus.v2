@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Subscribe"}}
	@overwrite

	@section('widget_body')
		<p>Untuk mendapatkan informasi dan discount paket tour, silahkan berlangganan newsletter kami dengan memasukkan email anda di bawah ini</p>
		{!! Form::open(['url' => route('web.subscription.add'), 'method' => 'POST']) !!}
			{!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Masukkan alamat email anda']) !!}
			<br/><button type='submit' class='btn btn-default btn-block'>SUBSCRIBE</button>
		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif