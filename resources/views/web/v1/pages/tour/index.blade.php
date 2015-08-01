<?php
	$bulan_id = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	$page_title = "Paket Tour";

	if ($vendor)
	{
		$page_subtitle .= ' oleh <strong class="text-primary">' . $vendor->name . '</strong>';
	}

	if ($tujuan)
	{
		$page_subtitle .= ' ke <strong class="text-primary">' . $tujuan->name . '</strong>';
	}

	if ($keberangkatan['month'] && $keberangkatan['year'])
	{
		$page_subtitle .= ' di bulan <strong class="text-primary">' . $bulan_id[$keberangkatan['month'] * 1] . ' ' . $keberangkatan['year'] . '</strong>';
	}

	if ($budget['min'])
	{
		$page_subtitle .= ' dengan budget <strong class="text-primary">Rp.' . number_format($budget['min'],0,',','.') .'-'.number_format($budget['max'],0,',','.'). '</strong>';
	}

	if ($page_subtitle || Input::get('page') > 1)
	{
		$page_subtitle = 'Menampilkan ' . (Input::get('page') > 1 ? ' halaman ' . Input::get(page) : '') . ($page_subtitle ? ' Tour ' . $page_subtitle : '');
	}


?>

@section('content_body')
	<div class="container-fluid">
		<div class="row">

			{{-- LEADERBOARD BEFORE CONTENT & SIDEBAR --}}
			<div class="hidden-xs hidden-sm col-md-12 hidden-lg mt-xs">
				@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			{{-- MAIN CONTENT --}}
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<div class='text-center hidden-md mt-md'>
					@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
				</div>

				<div class='mb-md'>

					<h1 class='text-uppercase'>
						{{$page_title}}
					</h1>
					<div class='text-uppercase text-black mb-lg'>{!! $page_subtitle !!}</div>
					
					@include('web.v1.widgets.tours.grid', [ 
						'tours'	=> $tours
					])
					
					@if (!$tours->count() && (count($other_tours['same_destination']) || count($other_tours['same_schedule']) || count($other_tours['same_budget'])))
						<?php 
							$total_column=0;
							foreach ($other_tours as $x)
							{
								if ($x->count())
								{
									$total_column++;
								}
							}
							$lg_col = 12 / $total_column;
						?>
						<div class="row mt-lg">
							@if ($other_tours['same_destination'] && $other_tours['same_destination']->count())
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-{{$lg_col}}">
									@if ($lg_col == 12)
										<hr class='border-dotted'>
										<h4>Tour Lainnya di bulan <strong class="text-primary"> {{$tujuan->name}} </strong></h4>
										@include('web.v1.widgets.tours.list', [ 
											'tours'	=> $other_tours['same_destination']
										])
									@else
										@include('web.v1.widgets.tours.list', [ 
											'widget_template' => 'well',
											'widget_title' => 'Tour ke <strong class="text-primary">' . $tujuan->name . '</strong>',
											'tours'	=> $other_tours['same_destination']
										])
									@endif
								</div>
							@endif
							@if ($other_tours['same_schedule']->count())
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-{{$lg_col}}">
									@if ($lg_col == 12)
										<hr class='border-dotted'>
										<h3>Tour Lainnya di bulan <strong class="text-primary"> {{$bulan_id[$keberangkatan['month'] * 1]}} {{$keberangkatan['year']}} </strong></h3>
										@include('web.v1.widgets.tours.grid', [ 
											'tours'	=> $other_tours['same_schedule']
										])
									@else
										@include('web.v1.widgets.tours.list', [ 
											'widget_template' => 'well',
											'widget_title' => 'Tour lain di bulan <strong class="text-primary">' . $bulan_id[$keberangkatan['month'] * 1] . ' ' . $keberangkatan['year'] . '</strong>',
											'tours'	=> $other_tours['same_schedule']
										])
									@endif
								</div>
							@endif
							@if ($other_tours['same_budget'] && $other_tours['same_destination']->count())
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-{{$lg_col}}">
									@if ($lg_col == 12)
										<hr class='border-dotted'>
										<h3>Tour dengan budget <strong class="text-primary">Rp. {{number_format($budget['min'],0,',','.')}} - {{number_format($budget['max'],0,',','.')}}</strong>,
										@include('web.v1.widgets.tours.list', [ 
											'tours'	=> $other_tours['same_budget']
										])
									@else
										@include('web.v1.widgets.tours.list', [ 
											'widget_template' => 'well',
											'widget_title' => 'Tour dengan budget <strong class="text-primary">Rp.' . number_format($budget['min'],0,',','.') .'-'.number_format($budget['max'],0,',','.'). '</strong>',
											'tours'	=> $other_tours['same_budget']
										])
									@endif
								</div>
							@endif
						</div>
					@else
						<div class="row mt-lg">
							@if ($other_tours['others'])
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-{{$lg_col}}">
									<hr class='border-dotted'>
									<h3>Tour Lainnya</h3>
									@include('web.v1.widgets.tours.grid', [ 
										'tours'	=> $other_tours['others']
									])
								</div>
							@endif
						</div>
					@endif
				</div>
			</div>

			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-md">
				@include('web.v1.widget_group.sidebar.basic')
			</div>

		</div>
	</div>
@stop