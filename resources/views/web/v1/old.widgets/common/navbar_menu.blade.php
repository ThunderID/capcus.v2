<?php
	// TUJUAN

	// KEBERANGKATAN
	$month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	$now = \Carbon\Carbon::now();
	for ($i = 0; $i <= 11; $i++)
	{
		$departure_lists[$now->year . str_pad($now->month, '2', '0', STR_PAD_LEFT)] = $month[$now->month] . ' ' . $now->year;
		$now->addMonth();
	}
?>

@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{route('web.home')}}">
						{!! Html::image('images/logo-white-sm.png', 'Capcus', ['class' => '', 'style' => 'max-height:100%']) !!}
					</a>
				</div>
			
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="{{route('web.tour')}}">SEMUA TOUR</a></li>
						<li><a href="#">SEMUA VENDOR</a></li>
						<li><a href="#">TUJUAN WISATA</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">SIGN UP / SIGN IN</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>

			<div class='pt-xs pb-xs bg-white hidden-xs'>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 searchbar text-center">
							{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']) !!}

								<span class='select-simple'>
									{!! Form::select('vendor', 
													["" => "Semua Vendor"] + ($VendorComposer['widget_data']['data']['vendor_db'] ? $VendorComposer['widget_data']['data']['vendor_db']->lists('name', 'slug') : []), 
													0, 
													['class' => 'width25', 'placeholder' => 'pilih vendor']) 
									!!}
								</span>
								&nbsp;
								
								<span class='select-simple'>
									{!! Form::select('tujuan', 
													["" => "Semua Tujuan"] + ($CategoryComposer['widget_data']['data']['category_db'] ? $CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'ori_path_name') : []), 
													0, 
													['class' => 'width25', 'placeholder' => 'pilih tujuan tour']) 
									!!}
								</span>
								&nbsp;

								<span class='select-simple'>
									{!! Form::select('keberangkatan', ['' => "Semua Keberangkatan"] + $departure_lists,
													null, 
													['class' => 'width25', 'placeholder' => 'pilih tanggal keberangkatan']) 
									!!}
								</span>
								&nbsp;

								<span class='select-simple'>
									{!! Form::select('budget', 
													$BudgetListComposer['widget_data']['data']['budget_list'], 
													0, 
													['class' => 'width25', 'placeholder' => 'pilih budget']) 
									!!}
								</span>

								<div class="clearfix hidden-sm hidden-md hidden-lg"></div>

								<button type='submit' class='btn btn-default'>CARI</button>
							{!! Form::close(); !!}
						</div>
					</div>
				</div>
			</div>
		</nav>
	@overwrite

	@section('js')
		@parent

		<link property='stylesheet' href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet" />
		<script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

		<link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" />
		<script src="{{asset('plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
		<script src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	
		<script>
			$('.select2').select2({});
			$('.daterangepicker').daterangepicker();
		</script>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif

