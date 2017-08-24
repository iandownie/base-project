"use strict";
(function($) {
    $(document).ready(function() {
        var cloning, carousel, flexible, toggler, full, stacking;
        if (typeof require === 'function') {
            cloning = require('./modules/cloning.js');
            carousel = require('./modules/carousel.js');
            toggler = require('./modules/toggler.js');
            full = require('./modules/full.js');
        }

        // Adds Tab Indexing to all elements with the "tabs" class.
        $(".can-tab").each(function(i) { $(this).attr('tabindex', i + 1); });
    });
})(jQuery);