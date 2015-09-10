@section('content_1')
	<?php
		$breadcrumbs['Home'] = route('web.home');
		$breadcrumbs['Bandingkan Tour'] = '';
	?>
	{{-- BREADCRUMB --}}
	@include('web.v3.components.common.breadcrumb', ['links' => $breadcrumbs])

	<section class="bg-place-page" style='height:100%;'>
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="blog-heading-content text-uppercase">
				<h2 class='text-yellow bg-black'>COMPARE TOUR</h2>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container mt-xl">
		<div class="row">
			<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
				<table class="table table-hover text-black">
					<thead>
						<tr>
							<th width='15%'>TRAVEL AGENT</th>
							<th>DETAIL</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td valign='top' colspan='2' class='bg-black text-yellow text-uppercase text-center text-bold'>Keberangkatan</td>
						</tr>
						@foreach ($tour_schedules as $x)
							<tr>
								<td valign='top'>
									{{$x->tour->name}}
									<br><img src='{{$x->tour->travel_agent->images->where("name", "SmallLogo")->first()->path}}'>
								</td>
								<td valign='top' align='center'>
									@if (is_null($x->departure_until))
										{{ $x->departure->format('d-m-Y')}}
									@else
										<span class='text-sm'>
											Kapanpun antara
											<br><span class="">{{ $x->departure->format('d-m-Y')}} s/d <br>{{ $x->departure_until->format('d-m-Y')}}</span>
										</span>
									@endif
								</td>
							</tr>
						@endforeach

						<tr>
							<td valign='top' colspan='2' class='bg-black text-yellow text-uppercase text-center text-bold'>Harga</td>
						</tr>
						@foreach ($tour_schedules as $x)
							<tr>
								<td valign='top'>
									{{$x->tour->name}}
									<br><img src='{{$x->tour->travel_agent->images->where("name", "SmallLogo")->first()->path}}'>
								</td>
								<td valign='top' align='center'>
									{{ $x->currency . ' ' . number_format($x->discounted_price, 0, ',','.')}}
									@if ($x->discounted_price < $x->original_price)
										<br>
										<span class='text-strikethrough text-primary'>
											<span class='text-light text-gray'>{{ $x->currency . ' ' . number_format($x->original_price, 0, ',','.')}}</span>
										</span>
									@endif
								</td>
							</tr>
						@endforeach

						<tr>
							<td valign='top' colspan='2' class='bg-black text-yellow text-uppercase text-center text-bold'>Tour Options</td>
						</tr>
						@foreach ($tour_schedules as $x)
							<tr>
								<td valign='top'>
									{{$x->tour->name}}
									<br><img src='{{$x->tour->travel_agent->images->where("name", "SmallLogo")->first()->path}}'>
								</td>
								<td valign='top' align='left'>
									@include('web.v3.components.tour_options.table_for_tour_schedule', ['tour_schedule' => $x, 'option_list' => $option_list, 'layout_style' => "list"])
								</td>
							</tr>
						@endforeach

						<tr>
							<td valign='top' colspan='2' class='bg-black text-yellow text-uppercase text-center text-bold'>Harga</td>
						</tr>
						@foreach ($tour_schedules as $x)
							<tr>
								<td valign='top'>
									{{$x->tour->name}}
									<br><img src='{{$x->tour->travel_agent->images->where("name", "SmallLogo")->first()->path}}'>
								</td>
								<td valign='top' align='center'>
									{{ $x->currency . ' ' . number_format($x->discounted_price, 0, ',','.')}}
									@if ($x->discounted_price < $x->original_price)
										<br>
										<span class='text-strikethrough text-primary'>
											<span class='text-light text-gray'>{{ $x->currency . ' ' . number_format($x->original_price, 0, ',','.')}}</span>
										</span>
									@endif
								</td>
							</tr>
						@endforeach

						<tr>
							<td valign='top' colspan='2' class='bg-black text-yellow text-uppercase text-center text-bold'>Detail</td>
						</tr>
						@foreach ($tour_schedules as $x)
							<tr>
								<td valign='top'>
									{{$x->tour->name}}
									<br><img src='{{$x->tour->travel_agent->images->where("name", "SmallLogo")->first()->path}}'>
								</td>
								<td valign='top' align=''>
									{!! $x->tour->ittinary !!}

									<p class='mt-lg'>
										<a href="{{route('web.tour.show', ['travel_agent_slug' => $x->tour->travel_agent->slug, 'tour_slug' => $x->tour->slug, 'schedule' => $x->departure->tour_optormat('Ymd')])}}" class='awe-btn awe-btn-style2 btn-block'>Detail</a>
									</p>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
				<table class="table table-hover text-black">
					<thead>
						<tr>
							<th width='15%'>KETERANGAN</th>
							@foreach ($tour_schedules as $x)
								<th class='text-center' width="{{ 85 / $tour_schedules->count() }}%">{{ $x->tour->name}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						<tr>
							<td valign='top'>Travel Agent</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align='center'><img src='{{ $x->tour->travel_agent->images->where('name', 'SmallLogo')->first()->path }}' style='height:40px'></td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'>Keberangkatan</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align='center'>
									@if (is_null($x->departure_until))
										{{ $x->departure->format('d-m-Y')}}
									@else
										<span class='text-sm'>
											Kapanpun antara
											<br><span class="">{{ $x->departure->format('d-m-Y')}} s/d <br>{{ $x->departure_until->format('d-m-Y')}}</span>
										</span>
									@endif
								</td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'>Harga</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align='center'>
									{{ $x->currency . ' ' . number_format($x->discounted_price, 0, ',','.')}}
									@if ($x->discounted_price < $x->original_price)
										<br>
										<span class='text-strikethrough text-primary'>
											<span class='text-light text-gray'>{{ $x->currency . ' ' . number_format($x->original_price, 0, ',','.')}}</span>
										</span>
									@endif
								</td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'>Tour Options</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align='left'>
									@include('web.v3.components.tour_options.table_for_tour_schedule', ['tour_schedule' => $x, 'option_list' => $option_list, 'layout_style' => "list"])
								</td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'>Harga</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align='center'>
									{{ $x->currency . ' ' . number_format($x->discounted_price, 0, ',','.')}}
									@if ($x->discounted_price < $x->original_price)
										<br>
										<span class='text-strikethrough text-primary'>
											<span class='text-light text-gray'>{{ $x->currency . ' ' . number_format($x->original_price, 0, ',','.')}}</span>
										</span>
									@endif
								</td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'>Detail</td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align=''>
									{!! $x->tour->ittinary !!}
								</td>
							@endforeach
						</tr>

						<tr>
							<td valign='top'></td>
							@foreach ($tour_schedules as $x)
								<td valign='top' align=''>
									<a href="{{route('web.tour.show', ['travel_agent_slug' => $x->tour->travel_agent->slug, 'tour_slug' => $x->tour->slug, 'schedule' => $x->departure->format('Ymd')])}}" class='awe-btn awe-btn-style2 btn-block'>Detail</a>
								</td>
							@endforeach
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop