
(function($) {
	"use strict";
	/*==============================
		Is mobile
	==============================*/
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
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

	function parallax() {
		$('.awe-parallax').each(function() {
			if (isMobile.any()) {
			} else {
				$(this).parallax("0%", 0.1);
			}
		});
	}

	function slider() {
		var paginationSlider = ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'];
		if ($('.purpose-slider').length) {
			$('.purpose-slider').owlCarousel({
				autoPlay: false,
				slideSpeed: 300,
				items: 7,
				navigation: true,
				pagination: false,
				autoHeight: true,
				navigationText: paginationSlider
			});
		}
		if ($('.related-slider').length) {
			$('.related-slider').owlCarousel({
				autoPlay: 10000,
				slideSpeed: 300,
				navigation: true,
				pagination: false,
				singleItem: true,
				autoHeight: true,
				navigationText: paginationSlider
			});
		}
		if ($('.product-slider').length) {
			$('.product-slider').owlCarousel({
				autoPlay: false,
				slideSpeed: 500,
				navigation: true,
				pagination: false,
				singleItem: true,
				autoHeight: true,
				navigationText: paginationSlider,
				afterAction : syncPosition
			});

			$('.product-slider-thumb').owlCarousel({
				slideSpeed: 500,
				items: 5,
				itemsCustom: [[320, 3],[480, 4], [768, 4], [992, 5], [1200, 5]],
				pagination:false,
				navigation:false,
				navigationText: paginationSlider,
				mouseDrag:false,
				afterInit : function(el){
				  el.find(".owl-item").eq(0).addClass("synced");
				}
			});
			
			$('.product-slider-thumb').on("click", ".owl-item", function(e){
				e.preventDefault();
				if($(this).hasClass('synced')){
					return false;
				}else{
					var number = $(this).data("owlItem");
					$('.product-slider').trigger("owl.goTo",number);
				}
			});
		}
	}

	function syncPosition(el){
		var current = this.currentItem;
		$('.product-slider-thumb')
			.find(".owl-item")
			.removeClass("synced")
			.eq(current)
			.addClass("synced")
		if($('.product-slider-thumb').data("owlCarousel") !== undefined){
			center(current)
		}
	}
	 
	function center(number){
		var slidethumnailvisible = $('.product-slider-thumb').data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in slidethumnailvisible){
			if(num == slidethumnailvisible[i]) {
				var found = true;
			}
		}
	 
		if(found == false){
			if(num>slidethumnailvisible[slidethumnailvisible.length-1]){
				$('.product-slider-thumb').trigger("owl.goTo", num - slidethumnailvisible.length+2)
			} else {
			if(num - 1 == -1) {
				num = 0;
			}
				$('.product-slider-thumb').trigger("owl.goTo", num);
			}
		} else if(num == slidethumnailvisible[slidethumnailvisible.length-1]) {
			$('.product-slider-thumb').trigger("owl.goTo", slidethumnailvisible[1])
		} else if(num == slidethumnailvisible[0]) {
			$('.product-slider-thumb').trigger("owl.goTo", num-1)
		}
	}

	function tabs() {
		$(".tabs").tabs({
			active: 0,
			show: {
				effect: "fade",
				duration: 200
			},
			hide: {
				effect: "fade",
				duration: 200
			}
		});
	}

	function seasonHover() {
		var season = $('.travelling-tabs__time').find('.season'),
			seasonItem = season.find('.item'),
			month = $('.travelling-tabs__time').find('.month'),
			monthItem = month.find('.item');
			seasonItem.each(function() {
				var $this = $(this);
				$this.hover(function() {
					$(this).addClass('hover-active');
					if ($(this).hasClass('spring')) {
						$('[data-season="spring"]').addClass('hover-active');
					}
					if ($(this).hasClass('summer')) {
						$('[data-season="summer"]').addClass('hover-active');
					}
					if ($(this).hasClass('autumn')) {
						$('[data-season="autumn"]').addClass('hover-active');
					}
					if ($(this).hasClass('winter')) {
						$('[data-season="winter"]').addClass('hover-active');
					}

				}, function() {
					$(this).removeClass('hover-active');
					monthItem.removeClass('hover-active');
				});
				monthItem.hover(function() {
					var $this = $(this),
						filterSeason = $this.data('season');
					$this.addClass('hover-active');
					$('.' + filterSeason).addClass('hover-active');
				}, function() {
					monthItem.removeClass('hover-active');
					seasonItem.removeClass('hover-active');
				});
			});
	}

	function magnificPopup() {
		if ($('.initiative-choose-other-open').length) {
			$('.initiative-choose-other-open').magnificPopup({
				type: 'ajax',
				closeMarkup: '<button title="%title%" class="mfp-close">Cancel <i class="awe-icon awe-icon-close-o"></i></button>'
			});
		}

		if ($('.flight-popup-open').length) {
			$('.flight-popup-open').magnificPopup({
				type: 'ajax',
				callbacks: {
					ajaxContentAdded: function() {
						var paginationSlider = ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'];
						$('.flight-popup__slider').owlCarousel({
							autoPlay: false,
							slideSpeed: 300,
							navigation: true,
							pagination: false,
							singleItem: true,
							autoHeight: true,
							navigationText: paginationSlider
						});
						$('.flight-popup__map-content-list').mdMapExtend({
							appendTo: '.flight-popup__map-info',
							autoCenter: true,
							zoom: 9,
							style: 'lightGray',
							iconMarker: 'images/marker.png',
							scrollwheel: false
						});
						if (isMobile.any()) {
						} else {
							$('.flight-popup__scrollbar').each(function() {
								var $scrollbar = $(this);
								$scrollbar.perfectScrollbar({
									maxScrollbarLength: 150,
									wheelSpeed: 0.5
								});
								$scrollbar.perfectScrollbar('update');
							});
						}

						$(".tabs").tabs({
							active: 0,
							show: {
								effect: "fade",
								duration: 200
							},
							hide: {
								effect: "fade",
								duration: 200
							},
							activate: function(event, ui) {
								$('.flight-popup__grid-wrapper .image-wrap').imageCover();
								if ($('.flight-popup__grid-wrapper', ui.newPanel).length && !$('.flight-popup__grid-wrapper',ui.newPanel).data('mansory-loaded')) {
									$('.flight-popup__grid-wrapper', ui.newPanel).masonry({
										columnWidth: '.grid-item.col-md-3',
										itemSelector: '.grid-item'
									});
									$('.flight-popup__grid-wrapper', ui.newPanel).data('mansory-loaded', 1);
								}
							}
						});
						if ($('.flight-popup__grid-wrapper').length) {
							$('.flight-popup__grid-wrapper .grid-item:nth-of-type(1), .flight-popup__grid-wrapper .grid-item:nth-of-type(10n + 1)')
								.removeClass('col-md-3')
								.addClass('col-md-6');

							$('.flight-popup__grid-wrapper .grid-item:nth-of-type(8), .flight-popup__grid-wrapper .grid-item:nth-of-type(10n + 8)')
								.removeClass('col-md-3')
								.addClass('col-md-6');
						}
					}
				}
			});
		}

		if ($('.full-price-open-popup').length) {
			$('.full-price-open-popup').magnificPopup({
				type: 'ajax',
				closeMarkup: '<button title="%title%" class="mfp-close">Cancel <i class="awe-icon awe-icon-close-o"></i></button>',
				callbacks: {
					ajaxContentAdded: function() {
						aweSelect();
						placeholder();

						$('.awe-calendar').each(function() {
							$(this).datepicker({
								showOtherMonths: true,
								selectOtherMonths: true,
								dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat']
							});
						});
					}
				}
			});
		}
	}
	function stickyMenu() {
		var $fixed = $('.header-page__inner'),
			offsetTop = $fixed.offset().top,
			scrollTop = $(window).scrollTop(),
			height = $fixed.outerHeight(),
			limitTop = offsetTop + height;
		$fixed.data('scrollTop', scrollTop); 
		$(window).scroll( function () {
			var scrollTop = $(window).scrollTop(),
				beforeTop = $fixed.data('scrollTop');  
		
			if (beforeTop < scrollTop) {
				if (!$fixed.hasClass('header-page__fixed')) {  
					if (scrollTop > limitTop ) {
						var transform = 'translateY(-'+ height +'px)';
						$fixed.addClass('header-page__fixed')
							.css({
								'-webkit-transform': transform,
								'-moz-transform': transform,
								'-ms-transform': transform,
								'-o-transform': transform,
								'transform': transform,
						}).data('y', height); 
					}
				}
				else {
					var y = $fixed.data('y'),
						offsetScroll = beforeTop - scrollTop,
						newTop = (y + offsetScroll) < height ? (y - offsetScroll) : height,
						newTransform = 'translateY(-'+ newTop +'px)'; 
					$fixed.css({
						'-webkit-transform': newTransform,
						'-moz-transform': newTransform,
						'-ms-transform': newTransform,
						'-o-transform': newTransform,
						'transform': newTransform,
					}).data('y', newTop);
				
				}
			}
			else {
				if ($fixed.hasClass('header-page__fixed')) {
				var y = $fixed.data('y'),
					offsetScroll = beforeTop - scrollTop,
					newTop = (y - offsetScroll) > 0 ? (y - offsetScroll) : 0,
					newTransform = 'translateY(-'+ newTop +'px)'; 
				
					$fixed.css({
						'-webkit-transform': newTransform,
						'-moz-transform': newTransform,
						'-ms-transform': newTransform,
						'-o-transform': newTransform,
						'transform': newTransform,
					}).data('y', newTop);
				
					if (scrollTop < offsetTop) {
						$fixed.removeClass('header-page__fixed'); 
						$fixed.css({
							'-webkit-transform': 'translateY(0px)',
							'-moz-transform': 'translateY(0px)',
							'-ms-transform': 'translateY(0px)',
							'-o-transform': 'translateY(0px)',
							'transform': 'translateY(0px)',
						}).data('y', newTop)
					}
				}
			}
			$fixed.data('scrollTop', scrollTop);
		}).trigger('scroll');
	}



	function subToggle() {
		if ($('.menu-list').find('.submenu-toggle').length === 0) {
			$('.menu-item-has-children')
				.children('a')
				.after(
						'<span class="submenu-toggle">\
							<i class="fa fa-angle-right"></i>\
						</span>\
					');
			$('.menu-list').on('click', '.submenu-toggle', function(evt) {
				evt.preventDefault();
				$(this)
					.siblings('.sub-menu')
					.addClass('sub-menu-active');
			});
		}
	}
	function submenuBack() {
		$('.menu-list .sub-menu').each(function() {
			var $this = $(this);
			if ($this.find('.back-mb').length === 0) {
				$this
					.prepend(
							'<li class="back-mb">\
								<a href="#">\
									<i class="fa fa-angle-left"></i>Back\
								</a>\
							</li>\
						');
			}
			$('.menu-list').on('click', '.back-mb a', function(evt) {
				evt.preventDefault();
				$(this)
					.parent()
					.parent()
					.removeClass('sub-menu-active');
			});
		});
	}

	function square_grid()
	{
		$('.grid_item > a > img').each(function(index, el) {
			$(this).height($(this).width());
		});
	}

	function addToCompareCart()
	{
		
	}

	$(window).on('load resize', function() {
		imageSquare();
		image43();
		var dataResponsive = $('.navigation').data('responsive'),
			windowWidth = window.innerWidth,
			windowHeight = window.innerHeight,
			headerHeight = $('#header-page').height();
		$('.toggle-menu-responsive').hide();
		if (windowWidth <= dataResponsive) {
			$('.toggle-menu-responsive').show();
			$('.navigation').prependTo('#page-wrap');
			$('.navigation')
				.removeClass('awe-navigation')
				.addClass('awe-navigation-responsive');
			$('.awe-navigation-responsive').height(windowHeight - headerHeight);
			$('.search-box .form-search').css('right', '-60px');
			subToggle();
			submenuBack();
		} else {
			$('.navigation').insertAfter('.header-page__inner .logo');
			$('.navigation')
				.removeClass('awe-navigation-responsive')
				.addClass('awe-navigation');
			$(document).find('.navigation').css('height', 'auto');
			$('.search-box .form-search').css('right', '0');
			$('.submenu-toggle, .back-mb').remove();
		}
		$('.search-box .form-search').width($('#header-page .container').width());
	});
	$('.toggle-menu-responsive').on('click', function(evt) {
		evt.preventDefault();
		$(this).toggleClass('toggle-active');
		$(document).find('.awe-navigation-responsive').toggleClass('awe-navigation-responsive-active');
	});
	$(window).load(function() {
		parallax();
		slider();
		square_grid();

		$('.daterangepicker').each(function(index, el) {
			var obj = $(this);
			obj.daterangepicker({
				dateLimit: {
					days: 180
				},
				startDate: moment(obj.data('start-date'), "YYYYMMDD"),
				endDate: moment(obj.data('end-date'), "YYYYMMDD"),
				ranges: { 
					'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
					'Bulan Depan': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
					'3 Bulan Mendatang': [moment(), moment().add(3, 'month').endOf('month')],
					'6 Bulan Mendatang': [moment(), moment().add(6, 'month').endOf('month')],
					// '1 Tahun Mendatang': [moment(), moment().add(1, 'year').endOf('month')]
				},
				"autoApply": true,
				locale: { 
					"format": 'DD-MM-YYYY',
					"separator":' s/d ',
					"daysOfWeek": [ "Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
					"monthNames": [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", 'November', 'Desember'],
					"fromLabel": "dari",
					"toLabel": "s/d",
					"firstDay": 1
				}
			});
		}); 

	   


		
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


	$(document).ready(function() {
		seasonHover();
		// magnificPopup();
		stickyMenu();

		$('.tab').tab();

		if ($('#header-page nav').hasClass('awe-navigation-hamburger')) {
			$('#header-page nav').attr('data-responsive', 100000);
		}


		if (isMobile.iOS()) {
			$('.awe-parallax, .awe-static')
				.addClass('fix-background-ios');
		}

		$('.write-review').on('click', function(evt) {
			evt.preventDefault();
			$('#add_review').slideToggle(400);
			$(this).toggleClass('write-review-active');
		});

		$('#page-wrap.dark').parent('body').addClass('body-dark');


		if ($('.product-map').length) {
			$('.product-map').mdMapExtend({
				appendTo: '.product-map',
				autoCenter: true,
				zoom: 10,
				style: 'shadesOfGrey',
				iconMarker: 'images/marker-product-map.png',
				scrollwheel: false
			});
		}
		if ($('.tour-map').length) {
			$('.tour-map').mdMapExtend({
				appendTo: '.tour-map',
				autoCenter: true,
				zoom: 10,
				style: 'shadesOfGrey',
				iconMarker: 'images/marker-product-map.png',
				scrollwheel: false
			});
		}
		if ($('.contact-page__map').length) {
			if (window.innerWidth >= 992) {
				$('.contact-page__map').height($('.contact-page__form').outerHeight());
			}
			$('.contact-page__map').mdMapExtend({
				appendTo: '.contact-page__map',
				autoCenter: true,
				zoom: 14,
				style: 'lightGray',
				iconMarker: 'images/marker.png',
				scrollwheel: false
			});
		}


		if (isMobile.any()) {
			$('.search-box').on('click', '.searchtoggle', function() {
				$(this).toggleClass('searchtoggle-active');
				$(this).siblings('.form-search').toggleClass('form-active');
			});
			$(document).on('click', function() {
				$('.search-box .searchtoggle').removeClass('searchtoggle-active');
				$('.search-box .form-search').removeClass('form-active');
				$('.minicart-body')
					.removeClass('cart-toggle');
				$('.toggle-minicart').removeClass('toggle-active');
			});
			$(document).on('click', '.search-box', function(e) {
				e.stopPropagation();
			});
		} else {
			$('.search-box').hover(function() {
				$('.search-box .form-search').addClass('form-active');
			}, function() {
				$('.search-box .form-search').removeClass('form-active');
			}); 
		}

	});
})(jQuery);