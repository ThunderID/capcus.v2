{!! Form::open(['method' => 'GET']) !!}
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-5 col-lg-5">
			<label class='text-black text-light'>Tujuan Wisata</label>
			<div class="form-item">
				{!! Form::select('', $place_list, '', ['class' => 'selectize']) !!}
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 pt-lg pl-0">
			<button class='btn btn-yellow btn-lg' style='padding:8px 10px !important'>CARI</button>
		</div>
	</div>
{!! Form::close() !!}