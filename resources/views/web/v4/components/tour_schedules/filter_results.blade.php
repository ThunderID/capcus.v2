<section>
	<div class="filter_tour">
		<h2>
			<a href="javascript:;" id="reset_filter_schedule" class='text-black text-light pull-right text-sm pt-5'>
				Reset <span class="glyphicon glyphicon-remove text-light" aria-hidden="true"></span>
			</a>
			FILTER
		</h2>
		
		{{-- WIDGET DURATION --}}
		<h3>Opsi Tampilan</h3>
		<div class="custom-checkbox mb-5">
			<input type="checkbox" value="1" class='filter_checkbox_place_detail' checked="checked" id='cb1'>
			<label for="cb1">Tampilkan Tujuan Wisata</label>
		</div>
		<div class="custom-checkbox mb-5">
			<input type="checkbox" value="1" class='filter_checkbox_paket_detail' checked="checked" id='cb2'>
			<label for="cb2">Tampilkan Detail Paket</label>
		</div>

		{{-- WIDGET PRICE --}}
		<h3 class='mb-md'>Harga</h3>
		<div class='text-center'>
			<input name="price" id='bootstrap-slider' data-min="0" data-max="{{ $filter_schedules['price']['max'] }}">
			<div class="price_label mt-xs mb-md" id='price_slider_label'>
				IDR <span class="from">{{ number_format(0,0,',','.') }}</span> - <span class="to">{{ number_format($filter_schedules['price']['max'],0,',','.') }}</span>
			</div>
		</div>
		<!-- END / WIDGET -->

		{{-- WIDGET TRAVEL AGENT --}}
		<h3>Travel Agent</h3>
		@foreach ($filter_schedules['travel_agents'] as $filter_val => $filter_str)
			<div class="custom-checkbox mb-5">
				<input type="checkbox" value="{{ $filter_val }}" class='filter_checkbox_travel_agent' checked="checked" id="filter_travel_{{$filter_val}}">
				<label for="filter_travel_{{$filter_val}}">{{ $filter_str }}</label>
			</div>
		@endforeach
		
		{{-- WIDGET DURATION --}}
		<h3>Tour Duration</h3>
		@foreach ($filter_schedules['durations'] as $filter_val => $filter_str)
			<div class="custom-checkbox mb-5">
				<input type="checkbox" value="{{ $filter_val }}" class='filter_checkbox_duration' checked="checked" id="filter_duration_{{$filter_val}}">
				<label for="filter_duration_{{$filter_val}}">{{ $filter_str }}</label>
			</div>
		@endforeach

		<div class='hidden-lg hidden-md hidden-sm mt-0 mb-xxl'>
			<h3>Sortasi</h3>
			{!! Form::select('sort_by', ['Tgl Keberangkatan', 'Travel Agent', 'Tujuan', 'Hari', 'Harga'], '', ['style' => 'width:100%', 'id' => 'select_sort_tour_result']) !!}
		</div>
	</div>
</section>

@section('js')
	@parent
	{!! Html::script('plugins/bootstrap-slider/bootstrap-slider.min.js') !!}

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
				min: 0,
				max: price_slider.data('max'),
				value: price_slider.data('value'),
				step: 100000,
				range: true,
				tooltip_split: true,
				tooltip: 'hide',
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

		$('.filter_checkbox_place_detail').on('change', function(event) {
			if ($(this).is(':checked'))
			{
				$('.tour_schedule_places_detail').slideDown();
			}
			else
			{
				$('.tour_schedule_places_detail').slideUp();
			}
			/* Act on the event */
		});

		$('.filter_checkbox_paket_detail').on('change', function(event) {
			if ($(this).is(':checked'))
			{
				$('.tour_schedule_paket_detail').slideDown();
			}
			else
			{
				$('.tour_schedule_paket_detail').slideUp();
			}
			/* Act on the event */
		});
	</script>
@stop