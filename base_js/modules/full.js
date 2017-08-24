"use strict";

/**
 * @doc driver
 * @name Full
 * @description
 *   Handles Full Functionality.
 *   Makes an element fill the entire screen height minus the header and footer height's.
 */

var Full = (function($){

	var currentState = null;
	var fullElements = $('.-full')
	var header = $('body > header');
	var footer = $('body > footer');

	function mobilizeFull(){
		var fullElement = $(this);
		fullElement.css('height', 'auto');
	}

	function deMobilizeFull(){
		var fullElement = $(this);
		var fullHeight = $(window).height() - header.outerHeight() - footer.outerHeight();
		fullElement.css('height', fullHeight+'px');
	}

	function adjustFull(){
		if( $(window).width() <= 1046 ){
			if( 'mobile' !== currentState ){
				fullElements.each(mobilizeFull);
				currentState = 'pc';
			}
		} else {
			if ( 'pc' !== currentState ){
				fullElements.each(deMobilizeFull);
				currentState = 'mobile';
			}
		}
	}

	if(fullElements.length > 0){
		$(window).resize(adjustFull);
		adjustFull();
	}

})(jQuery);

module.exports = Full;