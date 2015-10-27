function compare_cart_toggle()
{
	if ($('.compare_tour_cart').find('.content').css('display') != 'none')
	{
		$('.compare_tour.hide_list > i.glyphicon-chevron-up').hide();
		$('.compare_tour.hide_list > i.glyphicon-chevron-down').show();
	}
	else
	{
		$('.compare_tour.hide_list > i.glyphicon-chevron-up').show();
		$('.compare_tour.hide_list > i.glyphicon-chevron-down').hide();	
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

function rerender_compare_cart_list(data)
{
	$('.compare_tour_cart').find('.compare_tour_list').html('');

	compare_tour_cart = [];
	$.each(data, function(index, val) {
		$('.compare_tour_cart').find('.compare_tour_list').append($('<a href="javascript:;" class="btn btn-yellow compare_tour text-sm remove mr-5 mb-xs" data-id="'+val.id+'"><i class="glyphicon glyphicon-remove"></i> ' + val.tour.name + ' oleh ' + val.tour.travel_agent.name + '</a> '));
		compare_tour_cart.push(val.id);
	});

	$('a.go-compare').attr('href', 'http://capcus.id/tour/compare/' + compare_tour_cart.toString());
	compare_cart_toggle();
}

function add_compare_cart(id)
{
	$.ajax({
			url: web_url + 'api/compare/add',
			cache: false,
			data: {id: id},
			dataType: 'json',
			beforeSend: function() {
				$('.compare_tour.add[data-id='+id+']').addClass('disabled');
				$('.compare_tour.add[data-id='+id+'] > .bandingkan_label').html('Mengirim Data...');
			},
			success: function(data) { 
				if (data.error)
				{
					alert(data.error);

					$('.compare_tour.add[data-id='+id+']').removeClass('disabled');
					$('.compare_tour.add[data-id='+id+'] > .bandingkan_label').html('Bandingkan');
				}
				else
				{
					$('.compare_tour.add[data-id='+id+']').removeClass('disabled');
					$('.compare_tour.add[data-id='+id+'] > .bandingkan_label').html('Bandingkan');

					$('.compare_tour.add[data-id='+id+']').addClass('btn-bandingkan-active');
					$('.compare_tour.add[data-id='+id+'] > .glyphicon-ok').removeClass('hidden');
					rerender_compare_cart_list(data.data);
				}
			}
		});
	
}

function remove_compare_cart(id)
{
	$.ajax({
			url: web_url + 'api/compare/remove',
			cache: false,
			data: {id: id},
			dataType: 'json',
			beforeSend: function() {
				$('.compare_tour.add[data-id='+id+']').addClass('disabled');
				$('.compare_tour.add[data-id='+id+'] > .bandingkan_label').html('Mengirim Data...');
			},
			success: function(data) { 
				if (data.error)
				{
					alert(data.error);
				}
				else
				{
					$('.compare_tour.add[data-id='+id+']').removeClass('disabled');
					$('.compare_tour.add[data-id='+id+'] > .bandingkan_label').html('Bandingkan');

					$('.compare_tour.add[data-id='+id+']').removeClass('btn-bandingkan-active');
					$('.compare_tour.add[data-id='+id+'] > .glyphicon-ok').addClass('hidden');
					rerender_compare_cart_list(data.data);
				}
			}
		});
}


$(document).ready(function() {
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

	// COMPARE TOUR ACTION
	$('.compare_tour.add').on('click', function(event) {
		var self = $(this);

		if (self.hasClass('btn-bandingkan-active'))
		{
			remove_compare_cart(self.data('id'));
		}
		else
		{
			add_compare_cart(self.data('id'));
		}
	});


	// COMPARE TOUR ACTION
	$('.compare_tour_list').on('click', '.compare_tour.remove', function(event) {
		var self = $(this);
		remove_compare_cart(self.data('id'));
	});

});
