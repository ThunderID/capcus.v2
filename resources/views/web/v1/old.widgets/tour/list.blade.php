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
			$widget_errors->add($x, '$'.$x.': has not been handled');
			$widget_error_count++;
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// MISC
	// ------------------------------------------------------------------------------------------------------------------------
	if ($tours['result']['data'])
	{
		$tours['result']['data']->load('schedules', 'vendor', 'loved');
	}
?>

@extends('web.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Logo"}}
	@overwrite

	@section('widget_body')
		@if ($tours['result']['data'])
			<div class='row'>
				@foreach ($tours['result']['data'] as $k => $tour)
					<?php
						$most_discount_schedule = $tour->schedules->sortByDesc('discount')->first();
						$earliest_schedule = $tour->schedules->sortBy('depart_at')->first();
						$cheapest_schedule = $tour->schedules->sortBy('price')->first();
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								{!! Html::image($tour->thumbnail_lg, $tour->name, ['class' => 'fullwidth tour_thumbnail', 'data-src' => $tour->thumbnail_lg]) !!}
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<h4 class='text-bold'>{{$tour->name}}</h4>
								<br/><small>By {{$tour->vendor->name}}</small>
								<p class='price text-primary text-md mt-xs'>
									<span class='text-black text-sm'>mulai dari</span><br>
									{{$cheapest_schedule->currency}} {{number_format($cheapest_schedule->price)}}
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			@if (method_exists($tours['result']['data'], 'lastPage'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						{!! $tours['result']['data']->render() !!}
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