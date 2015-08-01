@section('area_2')
	<div class="row mt-lg">
		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4 text-center">
			<a href='{{route("admin.login")}}'>
				{!! Html::image(asset('images/logo-black.png'), '', ['class' => 'fullwidth']) !!}
			</a>
		</div>
	</div>

	<div class="row mt-lg">
		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
			@include('admin.widgets.common.alerts')
		</div>
	</div>

	<div class="row mt-lg">
		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
			@include('admin.widgets.login.form', [
													'widget_template' => 'well', 
													'form_url' 			=> route('admin.login.post'), 
													'id_field' 			=> 'email', 
												]
					)
		</div>
	</div>
@stop

@section('area_1')
@stop


@section('area_3')
@stop