<div class="page-sidebar">
	<div class="sidebar-title">
		<h2>Tour</h2>
		<div class="clear-filter">
			<a href="javascript:;" id="reset_filter_schedule">Reset</a>
		</div>
	</div>

	{{-- WIDGET PRICE --}}
	<div class="widget widget_price_filter">
		<h3>Harga</h3>
		<div class="price-slider-wrapper">
			<div class="price-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false" data-min="{{ $filter_schedules['price']['min'] }}" data-max="{{ $filter_schedules['price']['max'] }}"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 0%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div>
			<div class="price_slider_amount">
				<div class="price_label">
					<span class="from">IDR {{ $filter_schedules['price']['min'] }}</span> - <span class="to"> {{ $filter_schedules['price']['max']}} </span>
				</div>
			</div>
		</div>
	</div>
	<!-- END / WIDGET -->

	{{-- WIDGET TRAVEL AGENT --}}
	<div class="widget widget_has_radio_checkbox">
		<h3>Travel Agent</h3>
		<ul>
			@foreach ($filter_schedules['travel_agents'] as $filter_val => $filter_str)
				<li>
					<label>
						<input type="checkbox" value="{{ $filter_val }}" class='filter_checkbox_travel_agent' checked="checked">
						<i class="awe-icon awe-icon-check"></i>
						{{ $filter_str }}
					</label>
				</li>
			@endforeach
		</ul>
	</div>
	
	{{-- WIDGET DURATION --}}
	<div class="widget widget_has_radio_checkbox">
		<h3>Tour Duration</h3>
		<ul>
			@foreach ($filter_schedules['durations'] as $filter_val => $filter_str)
				<li>
					<label>
						<input type="checkbox" value="{{ $filter_val }}" class='filter_checkbox_duration' checked="checked">
						<i class="awe-icon awe-icon-check"></i>
						{{ $filter_str }}
					</label>
				</li>
			@endforeach
		</ul>
	</div>

	
</div>


@section('js')
	@parent

	<script>
		function filter_tour_schedule_result()
		{
			$('.tour_schedule_table > tbody > tr').each(function(index, el) {
				var show = true;
				var obj = $(this);

				// check duration filter
				if (!$('.filter_checkbox_duration[value="'+obj.data('duration')+'"]').is(':checked'))
				{
					show = false;
				}

				// check travel agent filter
				if (!$('.filter_checkbox_travel_agent[value="'+obj.data('travel-agent')+'"]').is(':checked'))
				{
					show = false;
				}

				// check price
				if ((obj.data('price') < $('.price-slider').data('value-min')) || (obj.data('price') > $('.price-slider').data('value-max')))
				{
					show = false;
				}

				if (show)
				{
					if (obj.is(':hidden'))
					{
						obj.addClass('bg-white');
					}


					obj.fadeIn(400, function(){
						obj.removeClass('bg-white');
					});
				}
				else
				{
					if (obj.not(':hidden'))
					{
						obj.addClass('bg-white');
					}


					obj.fadeOut(400, function(){
						obj.removeClass('bg-white');
					});
				}
			});
		}

		// FILTER BY DURATION
		$('.filter_checkbox_duration').change(function(event) {
			filter_tour_schedule_result();
		});

		// FILTER BY TRAVEL AGENT
		$('.filter_checkbox_travel_agent').change(function(event) {
			filter_tour_schedule_result();
		});

		$('.price-slider').on("slidechange", function(event,ui){
			$(this).data('value-min', ui.values[0]);
			$(this).data('value-max', ui.values[1]);
			filter_tour_schedule_result();
		});

		$('#reset_filter_schedule').click(function(event) {
			$('.filter_checkbox_duration').prop('checked', true).trigger('change');
			$('.filter_checkbox_travel_agent').prop('checked', true).trigger('change');
			$('.price-slider').slider('values', 0, 0);
			$('.price-slider').slider('values', 1, $('.price-slider').data('max'));
		});

	</script>
@stop