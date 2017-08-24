/**
 * utility to show/hide the template file names.
 * Usage:  (in browser console):  toggle_templates();
 */
;
(function($, window) {
    $(function() {
        var SHOW_THEME_FILE_NAMES=false;

        window.toggle_templates=window.toggle_templates || function() {
            var $debugEls = $(".template-name");
            if ($debugEls.length === 0) {
                return;
            }
            if ($debugEls.first().is("script")) {
                $debugEls.changeElementType("div");
            } else {
                $debugEls.changeElementType("script");
            }
            //return $debugEls;
        };
    }); // ready()
})(jQuery, window);


// jquery plugin to change an element's type.
// usage: $("span").changeElementType("div");
// all attributes are copied over, new element(s) returned.

(function($) {
    $.fn.changeElementType = function(newType) {
        var newElements = [];

        $(this).each(function() {
            var attrs = {};

            $.each(this.attributes, function(idx, attr) {
                attrs[attr.nodeName] = attr.nodeValue;
            });

            var newElement = $("<" + newType + "/>", attrs).append($(this).contents());

            $(this).replaceWith(newElement);

            newElements.push(newElement);
        });

        return $(newElements);
    };
})(jQuery);


/**
 * show bootstrap rows/cols
 */
(function($, window, undefined) {
    window.bootstrap_grid = function() {
        $("[class~=row]").addClass('bs-grid');
        $("[class^=col-]").addClass('bs-grid');
        $("[class^=col-].bs-grid").each(function(el){
            var cc = [];
            $(this.classList).each(function(c){
                if (this.indexOf('col') >= 0) {
                    cc.push(this);
                }
            });
            $(this).attr("data-content", cc.join(", "));
        });
    }
})(jQuery, window);




