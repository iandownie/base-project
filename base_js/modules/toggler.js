"use strict";

/**
 * @doc driver
 * @name Toggler
 * @description
 *   Handles Toggling a parent element's class name on and off when a child toggller classed element is clicked
 *   To use: Give the to-be-clicked element the class 'toggler' and give it the "data-toggle" attribute the class given to the parent element that should have the active class toggle on it. 
 */
var Toggler = (function ($) {
	if ( $('.toggler').length > 0 ){
		$('.toggler').each(function(){
			var toggler = $(this);
			if(toggler.data('toggle')){
				var parent = toggler.parents('.'+toggler.data('toggle'));
				toggler.click(function(){
					parent.toggleClass('active');
				});
			}
		});
	}
})(jQuery);

module.exports = Toggler;