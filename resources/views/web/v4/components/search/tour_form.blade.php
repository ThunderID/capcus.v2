<?php
	$required_variables = ['travel_agent_list', 'destination_list', 'departure_list', 'budget_list', 'default_filter_travel_agent', 'default_filter_tujuan', 'default_filter_keberangkatan', 'default_filter_budget', 'default_start_date_ymd', 'default_end_date_ymd'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ': ' . $x . ": Required", 1);
		}
	}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			{{-- PLAN YOUR DREAM TOUR --}}
			<div class="hidden-xs hidden-sm col-md-2 col-lg-2 pr-0" >
				<div class='bg-yellow text-center pt-lg pb-lg text-lg'>
					<span class='text-light'>PLAN YOUR</span>
					<br><span class='text-bold'>DREAM<br>TOUR</span>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 hidden-md hidden-lg" >
				<div class='bg-yellow text-center pt-sm pb-sm text-lg'>
					<span class='text-light'>PLAN YOUR</span>
					<br><span class='text-bold'>DREAM TOUR</span>
				</div>
			</div>

			{{-- SEARCH FORM --}}
			<div class="hidden-xs hidden-sm col-md-10 col-lg-10 pl-0">
				{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']); !!}
					<div class='bg-light-grey'>
						<div class='ml-sm mr-sm '>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pr-0 mt-md mb-md">
										{!! Form::select('tujuan', ['semua-tujuan' => "Semua Tujuan"] + $destination_list->lists('long_name', 'path_slug')->toArray(), $default_filter_tujuan, ['class' => 'form-control select2'])!!}
									</div>

									<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pr-0 mt-md mb-md">
										{!! Form::select('budget', $budget_list, $default_filter_budget ? $default_filter_budget : '', ['class' => 'select2 form-control']) !!}
									</div>

									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-md mb-md">
										<div class="input-daterange input-group" id="datepicker">
											{!! Form::text('keberangkatan_sejak', Input::old('keberangkatan_sejak', \Carbon\Carbon::now()->format('d-m-Y')), ['class' => 'form-control input-sm', 'placeholder' => 'tgl awal keberangkatan']) !!}
											<span class="input-group-addon">s/d</span>
											{!! Form::text('keberangkatan_hingga', Input::old('keberangkatan_hingga', \Carbon\Carbon::now()->addMonth(3)->format('d-m-Y')), ['class' => 'form-control input-sm', 'placeholder' => 'tgl akhir keberangkatan']) !!}
										</div>
									</div>
								</div>
						</div>
					</div>
					<div class='bg-white'>
						<div class='ml-sm mr-sm' style='padding:21px 0!important'>
							<span>BROWSE TOUR: </span>
							<span class='text-light'>
								@forelse ($tour_shortcut['tags'] as $label => $link)
									<a href='{{$link}}' class='mr-5 label bg-yellow text-black'>{{$label}}</a>
								@empty
								@endforelse
							</span>

							<button class='btn btn-yellow pull-right' style='margin-top:-5px;'>CARI TOUR</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>

			{{-- MOBILE --}}
			<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
				{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']); !!}
					<div class='bg-light-grey'>
						<div class='ml-sm mr-sm pt-5 pb-md'>
								<div class="clearfix mt-sm"></div>
								{!! Form::select('tujuan', ['semua-tujuan' => "Semua Tujuan"] + $destination_list->lists('long_name', 'path_slug')->toArray(), $default_filter_tujuan, ['class' => 'form-control select2'])!!}
								<div class="clearfix mt-sm"></div>
								{!! Form::select('budget', $budget_list, $default_filter_budget ? $default_filter_budget : '', ['class' => 'select2 form-control']) !!}
								<div class="row">
									<div class="input-daterange input-group" id="datepicker">
										{!! Form::text('keberangkatan_sejak', Input::old('keberangkatan_sejak', \Carbon\Carbon::now()->format('d-m-Y')), ['class' => 'form-control input-sm', 'placeholder' => 'tgl awal keberangkatan']) !!}
										<span class="input-group-addon">s/d</span>
										{!! Form::text('keberangkatan_hingga', Input::old('keberangkatan_hingga', \Carbon\Carbon::now()->addMonth(3)->format('d-m-Y')), ['class' => 'form-control input-sm', 'placeholder' => 'tgl akhir keberangkatan']) !!}
									</div>
								</div>
						</div>
					</div>
					<div class='bg-white'>
						<div class='ml-sm mr-sm' style='padding:21px 0!important'>
							<div class='row'>
								<div class='col-xs-12 text-center'>
									<div>BROWSE TOUR </div>
									<span class='text-light'>
										@forelse ($tour_shortcut['tags'] as $label => $link)
											<a href='{{$link}}' class='mr-5 label bg-yellow text-black'>{{$label}}</a>
										@empty
										@endforelse
									</span>
								</div>
								<div class='col-xs-6 col-xs-offset-3 mt-xxl'>
									<button class='btn btn-yellow btn-block'>CARI TOUR</button>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>