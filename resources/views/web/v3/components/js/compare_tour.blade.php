<div class="compare_tour_cart">
	<a href='javascript:;' class='show-toggle compare_tour hide_list'>
		<i class='fa fa-chevron-up' style='display:none'></i>
		<i class='fa fa-chevron-down' style='display:none'></i>
	</a>
	<div class="container">
		<div class='content pt-sm'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tour_list">
					<a href='' class='pull-right awe-btn awe-btn-style2'>Bandingkan</a>
					<strong>BANDINGKAN</strong><br>
					@forelse ($compare_cart as $k => $cart)
						{{ ($k ? ', ' : '')}} {{$cart->tour->name}}
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
</div>

		
<script>
	@if (Session::has('compare_cart'))
		@if (is_array(Session::get('compare_cart')))
			var compare_tour_cart = [ {{ implode(',', Session::get('compare_cart')) }} ];
		@else
			var compare_tour_cart = [ {{ implode(',', [Session::get('compare_cart')]) }} ];
		@endif
	@else
		var compare_tour_cart = [];
	@endif

	$(document).ready(function(){
		compare_cart_toggle();
	});


	function compare_cart_toggle()
	{
		if ($('.compare_tour_cart').find('.content').css('display') != 'none')
		{
			$('.compare_tour.hide_list > i.fa-chevron-up').hide();
			$('.compare_tour.hide_list > i.fa-chevron-down').show();
		}
		else
		{
			$('.compare_tour.hide_list > i.fa-chevron-up').show();
			$('.compare_tour.hide_list > i.fa-chevron-down').hide();	
		}

		if (compare_tour_cart.length)
		{
			$('.compare_tour_cart').show();
		}
		else
		{
			$('.compare_tour_cart').hide();
		}
	}
	// COMPARE TOUR ACTION
	$('.compare_tour.add').on('click', function(event) {
				var self = $(this);
				$.ajax({
					url: '{{route("api.compare.add")}}',
					cache: false,
					data: {id: self.data('id')},
					dataType: 'json',
					success: function(data) { 
						if (data.length)
						{
							$('.compare_tour_cart').fadeIn();
						}
						$('.compare_tour_cart').find('.content').html(data);
					}
				})
			});

	// COMPARE TOUR CART
	$('.compare_tour.hide_list').click(function(){
		$('.compare_tour_cart').find('.content').animate(
			{
				height: "toggle"
			},
			500, function() {
				compare_cart_toggle()
		});
	});
</script>