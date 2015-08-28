<div class="page-sidebar filter_tour_schedule_results">
	<div class="sidebar-title">
		<h2>Tour</h2>
		<div class="clear-filter">
			<a href="javascript:;" id="reset_filter_schedule">Reset</a>
		</div>
	</div>

	{{-- WIDGET PRICE --}}
	<div class="widget widget_price_filter">
		<h3>Harga</h3>
		<input name="price" id='bootstrap-slider' data-min="0" data-max="{{ $filter_schedules['price']['max'] }}">
		<div class="price_label mt-xs mb-md" id='price_slider_label'>
			IDR <span class="from">{{ number_format(0,0,',','.') }}</span> - <span class="to">{{ number_format($filter_schedules['price']['max'],0,',','.') }}</span>
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
				var price = $('#bootstrap-slider').val().split(',');
				if ((obj.data('price') < price[0]*1) || (obj.data('price') > price[1]*1))
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

		var price_slider = $("#bootstrap-slider");


		// FILTER BY DURATION
		$('.filter_checkbox_duration').change(function(event) {
			filter_tour_schedule_result();
		});

		// FILTER BY TRAVEL AGENT
		$('.filter_checkbox_travel_agent').change(function(event) {
			filter_tour_schedule_result();
		});

		$('#reset_filter_schedule').click(function(event) {
			$('.filter_checkbox_duration').prop('checked', true);
			$('.filter_checkbox_travel_agent').prop('checked', true);
			price_slider.slider('setValue', [$('#bootstrap-slider').data('min'), $('#bootstrap-slider').data('max')]);
			filter_tour_schedule_result();
		});


		$(document).ready(function(){
			price_slider.slider({
				min: price_slider.data('min'),
				max: price_slider.data('max'),
				value: price_slider.data('value'),
				step: 250000,
				range: true,
				tooltip_split: true,
				formatter: function(x) {
					return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				}
			})

			price_slider.on('slideStop', function(){
				filter_tour_schedule_result();
			})

			price_slider.on('slide', function(){
				x = price_slider.val().split(",");
				$('#price_slider_label > .from').html(x[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
				$('#price_slider_label > .to').html(x[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
			})
		});
	</script>
@stop