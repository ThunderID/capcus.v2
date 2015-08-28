@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Login"}}
	@overwrite

	@section('widget_body')
		<p class='text-center text-regular'>Anda dapat membuat akun atau login dengan:</p>
		<div class="row">
			<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<div class="row mb-xs">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a href="{{route('web.login', ['provider' => 'twitter'])}}" class='btn btn-block btn-default'><i class='fa fa-twitter-square'></i> Twitter</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a href="{{route('web.login', ['provider' => 'facebook'])}}" class='btn btn-block btn-default'><i class='fa fa-facebook-square'></i> Facebook</a>
					</div>
				</div>

				<div class="row mt-md">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-5">
						<hr class='border-1 border-light mt-xs'>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 text-center text-bold text-light">
						ATAU
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-5">
						<hr class='border-1 border-light mt-xs'>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-md">
						<form action="" method="POST" role="form">
						{!!  Form::open(['url' => route('web.login.post'), 'method' => 'post'])!!}
							<div class="form-group">
								<input type="text" class="form-control" id="" placeholder="email" name='email'>
							</div>

							<div class="form-group">
								<input type="password" name='password' class="form-control" id="" placeholder="password">
							</div>
						
							<p class='text-center'>
								<button type="submit" class="btn btn-default text-light"><strong class='text-uppercase text-light text-md'>Buat Akun</strong> atau <strong class='text-uppercase text-light text-md'>Login</strong></button>
							</p>

							<p class='text-center'>
								<a href='' class='text-uppercase text-sm'>LUPA PASSWORD</a>
							</p>

							<p class='text-center text-sm'>
								Dengan anda membuat akun di capcus, anda telah setuju pada <a href=''>term and condition</a> kami
							</p>

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif