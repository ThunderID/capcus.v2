<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['tours'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// MISC
	// ------------------------------------------------------------------------------------------------------------------------
	if ($tours->count())
	{
		$tours->load('schedules', 'vendor', 'loved');
	}
?>

@extends('web.v1.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{!! $widget_title or "Tour List" !!}
	@overwrite

	@section('widget_body')
		@if ($tours)
			<div class='row'>
				@foreach ($tours as $k => $tour)
					@if ($k)
						<hr class='border-dotted mb-md'>
					@endif

					<?php
						$most_discount_schedule = $tour->schedules->sortByDesc('discount')->first();
						$earliest_schedule = $tour->schedules->sortBy('depart_at')->first();
						$cheapest_schedule = $tour->schedules->sortBy('price')->first();
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								{!! HTML::image($tour->thumbnail_lg, $tour->name, ['class' => 'fullwidth tour_thumbnail', 'data-src' => $tour->thumbnail_lg]) !!}
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<h4 class='text-bold'>
									{{$tour->name}}
									<br><small>By {{$tour->vendor->name}}</small>
								</h4>
								<p class='price text-primary text-md mt-xs text-right'>
									<span class='text-black text-sm'>mulai dari</span><br>
									{{$cheapest_schedule->currency}} {{number_format($cheapest_schedule->price)}}
								</p>

								<p class='text-center'>
									<a href='{{route("web.tour.show", ["vendor_slug" => $tour->vendor->slug, "tour_slug" => $tour->slug])}}' class='btn btn-primary btn-block text-black'>DETAIL</a>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			@if (method_exists($tours, 'lastPage'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						{!! $tours->render() !!}
					</div>
				</div>
			@endif
		@else
			No 
		@endif
	@overwrite

	@section('js')
		@parent

		<script>
			
			$('.toggle_love').click(function(event) {
				var obj = $(this);
				$.ajax({
					url: '{{route("api.me.love_tour")}}',
					type: 'GET',
					dataType: 'json',
					data: {tour_slug: obj.data('tour-slug')},
				})
				.done(function(data) {
					if (data.status == 'success')
					{
						if (data.data.love == 0)
						{
							obj.find('i').removeClass('fa-heart').addClass('fa-heart-o');
						}
						else
						{
							obj.find('i').removeClass('fa-heart-o').addClass('fa-heart');
						}
					}
				})
				.fail(function(data) {
					if (data.status == 401)
					{
						show_login_modal();
					}
					else
					{
						alert('Invalid Request');
					}
				});
				event.preventDefault();
			});
		</script>


	@stop
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif