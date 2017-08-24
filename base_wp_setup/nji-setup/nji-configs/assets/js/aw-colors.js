jQuery(document).ready(function($) {

    // Add custom colors to ACF color picker (Iris)
    if (acf.fields.color_picker) {
        var palette = ['#702082', '#000000', '#efeede', '#c8d7df', '#d8dbd8', '#d9e6dc', '#ddd0cf'];
        acf.add_action('append load', function($el) {
            $(acf.fields.color_picker.$input).iris('option', 'palettes', palette);
        });
    }
});