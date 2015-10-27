(function($) {
	"use strict";
	/*==============================
		Is mobile
	==============================*/
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	/*==============================
		Image cover
	==============================*/
	$.fn.imageCover = function() {
		$(this).each(function() {
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
			}
		});
	}

	function imageSquare() {
		$('img.imagesquare').each(function() {
			var self = $(this);
			self.width('100%');
			self.height(self.width());
		});
	}

	function image43() {
		$('img.image43').each(function() {
			var self = $(this);
			self.width('100%');
			self.height(self.width() * 3/4);
		});
	}

	function square_grid()
	{
		$('.grid_item > a > img').each(function(index, el) {
			$(this).height($(this).width());
		});
	}

	$(window).on('load resize', function() {
		imageSquare();
		image43();
	});

	$(window).load(function() {
		square_grid();

		// $('.daterangepicker').each(function(index, el) {
		// 	var obj = $(this);
		// 	obj.daterangepicker({
		// 		dateLimit: {
		// 			days: 180
		// 		},
		// 		startDate: moment(obj.data('start-date'), "YYYYMMDD"),
		// 		endDate: moment(obj.data('end-date'), "YYYYMMDD"),
		// 		ranges: { 
		// 			'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
		// 			'Bulan Depan': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
		// 			'3 Bulan Mendatang': [moment(), moment().add(3, 'month').endOf('month')],
		// 			'6 Bulan Mendatang': [moment(), moment().add(6, 'month').endOf('month')],
		// 			// '1 Tahun Mendatang': [moment(), moment().add(1, 'year').endOf('month')]
		// 		},
		// 		"autoApply": true,
		// 		locale: { 
		// 			"format": 'DD-MM-YYYY',
		// 			"separator":' s/d ',
		// 			"daysOfWeek": [ "Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
		// 			"monthNames": [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", 'November', 'Desember'],
		// 			"fromLabel": "dari",
		// 			"toLabel": "s/d",
		// 			"firstDay": 1
		// 		}
		// 	});
		// }); 

	   


		
		$('.image-cover').imageCover();
		if ($('body').hasClass('single-post') === false) {
			$('.post .image-wrap').addClass('image-style');
			setTimeout(function() {
				$('.post .image-wrap').imageCover();
			},10);
		}
		$('.related-post .post .image-wrap').addClass('image-style');
		setTimeout(function() {
			$('.related-post .post .image-wrap').imageCover();
		},10);
	});
		
	// CUSTOM BY ERICK
	$( window ).on('resize', function() {
		square_grid();
	});

	$(document).ready(function(){
		// SELECT2
		$('.select2').each(function() { 
			$(this).select2({
				placeholder: $(this).data('placeholder')
			});
		});
	});
})(jQuery);