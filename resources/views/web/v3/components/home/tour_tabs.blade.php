<?php
	$required_variables = ['promo_tours', 'latest_tours'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.home.tour_tabs: ' . $x . ": Required", 1);
		}
	}
?>

<div role="tabpanel" class="bs-tab-yellow-border">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs tab-tour" role="tablist" class='active'>
		<li role="presentation">
			<a href="#tour_terbaru" aria-controls="tab" role="tab" data-toggle="tab">Terbaru</a>
		</li>
		<li role="presentation" role='tablist'>
			<a href="#tour_promo" aria-controls="home" role="tab" data-toggle="tab">Promo</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="tour_terbaru">
			@foreach ($latest_tours as $tour)
				@include('web.v3.components.tours.tour_item', ['tour' => $tour])
			@endforeach
		</div>
		<div role="tabpanel" class="tab-pane " id="tour_promo">
			@foreach ($promo_tours as $tour)
				@include('web.v3.components.tour_schedules.tour_schedule_item', ['tour_schedule' => $tour])
			@endforeach
		</div>
	</div>
</div>

@section('js')
	@parent

	<script>
		$('.tab-tour > li > a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			// console.log($(e.target.getAttribute('href') + ' > .trip-item > .item-media > .image-cover'));
			$(e.target.getAttribute('href') + ' > .trip-item > .item-media > .image-cover').each(function(index, el) {
				var self = $(this),
				image = self.find('img'),
				heightWrap = self.outerHeight(),
				widthImage = image.outerWidth(),
				heightImage = image.outerHeight();
				if (heightImage < heightWrap) {
					image.css({
						'height': '100%',
						'width': 'auto'
					});
				}});
		});
	</script>
@stop