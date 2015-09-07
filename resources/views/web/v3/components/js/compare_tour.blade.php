<div class="compare_tour_cart">
	<a href='javascript:;' class='show-toggle compare_tour hide_list'>
		<i class='fa fa-chevron-up' style='display:none'></i>
		<i class='fa fa-chevron-down' style='display:none'></i>
	</a>
	<div class="container">
		<div class='content pt-sm'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
					<strong>BANDINGKAN</strong><br>
					<div class='hidden-xs hidden-sm compare_tour_list'>
						@forelse ($compare_cart as $k => $cart)
							<a href='javascript:;' class='awe-btn awe-btn-style2 compare_tour remove text-sm  mr-5 mb-xs ' data-id='{{$cart->id}}'><i class='fa fa-close'></i> {{$cart->tour->name}} ({{$cart->tour->travel_agent->name}})</a>
						@empty
						@endforelse
					</div>
					<div class='hidden-md hidden-lg compare_tour_list'>
						@forelse ($compare_cart as $k => $cart)
							<a href='javascript:;' class='awe-btn awe-btn-style2 compare_tour remove text-sm  mr-5 mb-xs ' data-id='{{$cart->id}}'><i class='fa fa-close'></i> {{$cart->tour->name}} ({{$cart->tour->travel_agent->name}})</a>
						@empty
						@endforelse
					</div>
				</div>
				<div class="hidden-xs hidden-sm col-md-2 col-lg-2 tour_list">
					<a href='{{ route("web.tour.compare") }}' class='pull-right awe-btn awe-btn-style2 pt-xl pb-xl mt-xs'>Bandingkan</a>
				</div>
				<div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center bg-black">
					<a href='{{ route("web.tour.compare") }}' class='awe-btn awe-btn-style2 mt-xs mb-xs'>Bandingkan</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	@if (Session::has('compare_cart'))
		@if (is_array(Session::get('compare_cart')) && count(Session::get('compare_cart') > 0))
			var compare_tour_cart = [ {{ implode(',', Session::get('compare_cart')) }} ];
		@else
			var compare_tour_cart = [  ];
		@endif
	@else
		var compare_tour_cart = [];
	@endif

	$(document).ready(function(){
		compare_cart_toggle();
	});

</script>