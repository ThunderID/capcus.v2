<?php
	for ($i = date('Y') - 5; $i >= date('Y') - 120; $i--)
	{
		$tahun_list[$i] = $i;
	}

	$bulan_list[1] = "Januari";
	$bulan_list[2] = "Februari";
	$bulan_list[3] = "Maret";
	$bulan_list[4] = "April";
	$bulan_list[5] = "Mei";
	$bulan_list[6] = "Juni";
	$bulan_list[7] = "Juli";
	$bulan_list[8] = "Agustus";
	$bulan_list[9] = "September";
	$bulan_list[10] = "Oktober";
	$bulan_list[11] = "November";
	$bulan_list[12] = "Desember";

	$gender_list['pria'] = "Pria";
	$gender_list['wanita'] = "Wanita";

	for ($i = 1; $i <= 31; $i++)
	{
		$day_list[$i] = $i;
	}
?>

@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					Complete Profile
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			@if ($errors->count())
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 mt-xxxl">
						<div class="alert bg-yellow pb-lg text-uppercase">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						    <div class='pull-left text-xxxl mr-lg'><i class='fa fa-warning'></i></div>
						    <div class='mt-xs'>
							    @foreach ($errors->all(':message<br>') as $k => $v)
							    	{!! $v !!}
							    @endforeach
						    </div>
						</div>
					</div>
				</div>
			@endif
			<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 bg-white pt-xl pb-xl border-1 border-solid border-black mt-lg">
				<h1 class='mt-0 pt-0'>Satu Langkah Lagi,</h1>

				{!! Form::open(['url' => route('web.me.profile.complete.post'), 'method' => 'POST']) !!}
					<p class='mt-lg'>
						<label>Email</label>
						<br>{!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
					</p>

					<p class='mt-lg'>
						<label>Gender</label>
						<br>{!! Form::select('gender', $gender_list, Auth::user()->gender, ['class' => 'select2'])!!}
					</p>

					<p class='mt-lg'>
						<label>Tanggal Lahir</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								{!! Form::select('year', $tahun_list, Auth::user()->dob->year, ['class' => 'select2', 'style' => 'width:30%', 'id' => 'selectize_year'])!!}
								{!! Form::select('month', $bulan_list, Auth::user()->dob->month, ['class' => 'select2', 'style' => 'width:30%', 'id' => 'selectize_month'])!!}
								{!! Form::select('day', $day_list, Auth::user()->dob->day, ['class' => 'select2', 'style' => 'width:30%'])!!}
							</div>
						</div>
					</p>

					<p class='mt-xxl'>
						<button type='submit' class='btn btn-block btn-yellow'>Simpan</button>
					</p>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('body_class')
	bg-seamless
@stop


@section('search_tour_tab')
@stop

@section('ads_leaderboard')
@overwrite


@section('content_2')
	
@stop