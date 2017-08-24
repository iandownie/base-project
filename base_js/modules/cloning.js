"use strict";

/**
 * @doc driver
 * @name Cloning
 * @description
 *   Forces cloned elements to have height equal to the talest among their fellow clones
 */
var Cloning = (function ($) { 
	// Clone Heights of all elements on a page with the .clone class:
	var cloneHeights = function(){
		var cloneParent=$('.clone.-parent');
		cloneParent.each(function(){
			var minHeight=0;
			var clones = $(this).find('.clone.-height');
			clones.each(function(){
				var cloneHeight = $(this).css('height', 'auto').outerHeight();
				if(cloneHeight> minHeight){
					minHeight = cloneHeight+2;
				}
			});
			clones.each(function(){
				$(this).css('height', minHeight);
			});
		});
	}
	if($('.clone.-height').length > 0){
		cloneHeights();
		$(window).resize(cloneHeights);
	}

})(jQuery);

module.exports = Cloning;