"use strict";

/**
 * @doc driver
 * @name Carousel
 * @description
 *   Handles Carousel Functionality
 */

var Carousel = (function($){

	function carouselFunctionality(){
		var carousels = $('.carousel');
		carousels.each(function(){
			var carousel = $(this);
			var slides = carousel.find('.slide');
			var timing = Number(carousel.data('timing'));
			slides.last().addClass('-last');
			slides.first().addClass('-first active');
			carousel.find('.controller.-absolute').click(function(){
				var controller = $(this);
				if(!controller.hasClass('active')){
					controller.siblings('.controller.-absolute').removeClass('active');
					controller.addClass('active');
					var slideId = controller.data('slide');
					$.each(slides,function(){
						var slide = $(this);
						slide.find('.clock .hand').css('transition', 'all '+(timing/1000)+'s linear');
						if(slide.hasClass(slideId)){
							slide.addClass('-prepared').addClass('active');
							setTimeout(function(){
								slide.removeClass('-prepared');
							},5);
						}else if(slide.hasClass('active')){
							slide.removeClass('active').addClass('-closing');
							setTimeout(function(){
								slide.removeClass('-closing');
							}, 2000);
						}
					});
				}
			});
			// continuousPhasing(carousel, timing);
		});
	}

	function continuousPhasing(carousel, timing = 6000){
		setTimeout(function(){
			var currentActiveSlide = carousel.find('.controller.-absolute.active');
			if(currentActiveSlide.hasClass('-last')){
				currentActiveSlide.siblings('.controller.-absolute.-first').trigger('click');
			}else{
				currentActiveSlide.next().trigger('click');
			}
			continuousPhasing(carousel, timing);
		}, timing);
	}

	if( $('.carousel').length > 0 ){
		carouselFunctionality();
	}

})(jQuery);

module.exports = Carousel;