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
	<section class="awe-parallax" style="background-position: 50% 12px;">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-push-3 text-black">
					<h3 class=' text-center'>SATU LANGKAH LAGI,</h3>

					@if ($errors->count())
						<div class="alert bg-yellow pb-lg">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						    <div class='pull-left text-xxxl mr-lg'><i class='fa fa-warning'></i></div>
						    @foreach ($errors->all(':message<br>') as $k => $v)
						    	{!! $v !!}
						    @endforeach
						</div>
					@endif

					<div class="panel panel-default">
						<div class="panel-body">
							{!! Form::open(['url' => route('web.me.profile.complete.post'), 'method' => 'POST']) !!}
								<p class='mt-lg'>
									<label>Email</label>
									<br>{!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
								</p>

								<p class='mt-lg'>
									<label>Gender</label>
									<br>{!! Form::select('gender', $gender_list, Auth::user()->gender, ['class' => 'selectize'])!!}
								</p>

								<p class='mt-lg'>
									<label>Tanggal Lahir</label>
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											{!! Form::select('year', $tahun_list, Auth::user()->dob->year, ['class' => 'selectize', 'id' => 'selectize_year'])!!}
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											{!! Form::select('month', $bulan_list, Auth::user()->dob->month, ['class' => 'selectize', 'id' => 'selectize_month'])!!}
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											{!! Form::select('day', $day_list, Auth::user()->dob->day, ['class' => 'selectize'])!!}
										</div>
									</div>
								</p>

								<p class='mt-lg'>
									<button class='submit' class='btn btn-yellow'>Simpan</button>
								</p>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
@stop

@section('js')
	@parent

	{!! HTML::script('plugins/selectize/js/standalone/selectize.min.js') !!}
	{!! HTML::style('plugins/selectize/css/selectize.css') !!}
	<script>
		$('.selectize').selectize({});

		function repopulate_dob_date()
		{

			var month_select = $('select[name=month]')[0].selectize;
			var day_select = $('select[name=day]')[0].selectize;
			var year_select = $('select[name=year]')[0].selectize;


			switch (month_select.getValue() * 1)
			{
				case 1: case 3: case 5: case 7: case 8: case 10: case 12:
					for (i = 28; i<=31; i++)
					{
						day_select.addOption({value: i, text:i});
					}
					day_select.refreshOptions(false);
					break;
				case 4: case 6: case 9: case 11:
					for (i = 28; i<=30; i++)
					{
						if (!day_select.getOption(i).length)
						{
							day_select.addOption({value: i, text:i});
						}
					}
					for (i = 31; i<=31; i++)
					{
						day_select.removeOption(i);
					}
					break;

				case 2:
					var is_leap = new Date(year_select.getValue(), 1, 29).getMonth() == 1;
					console.log(is_leap);

					for (i = (is_leap ? 30 : 29 ); i<=31; i++)
					{
						day_select.removeOption(i);
					}
					break;
			}
		}

		$('#selectize_month')[0].selectize.on('change', function(event) {
			repopulate_dob_date()
		});
		$('#selectize_year')[0].selectize.on('change', function(event) {
			repopulate_dob_date()
		});
	</script>
@stop