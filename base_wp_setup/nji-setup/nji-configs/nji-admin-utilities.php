<?php
// Add custom colors to ACF picker.
add_action('acf/input/admin_enqueue_scripts', function() {
  $path = plugins_url('assets/js/aw-colors.js', __FILE__ );
  wp_enqueue_script( 'acf-custom-colors', $path, 'acf-input', '1.0', true );
});

//Hide admin bar functionality
function njimedia_setup_admin_bar(){
        if( (is_admin()) || (!is_admin_bar_showing())){
                return;
        }
        echo '
                <style type="text/css">
                        #wpadminbar{
                                background:transparent !important;
                        }
                        #wpadminbar ul li{
                                display:none;
                        }
                        #wpadminbar ul li#wp-admin-bar-wp-logo{
                                display:inline-block;
                        }

                        #wpadminbar:hover{
                                background:#222 !important;
                        }
                        #wpadminbar:hover ul li
                        {       display:inline-block;
                        }
                        body.admin-bar{
                                margin-top: -32px !important;
                        }
                </style>
        ';
}
add_action( 'wp_print_styles', 'njimedia_admin_bar' );

// Callback function to insert 'styleselect' into the $buttons array
function njimedia_setup_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'njimedia_mce_buttons_2' );

// Callback function to filter the MCE settings
function njimedia_setup_mce_before_init_insert_formats( $init_array ) {  
  // Define the style_formats array
  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => '.translation',  
      'block' => 'blockquote',  
      'classes' => 'translation',
      'wrapper' => true,
      
    ),  
    array(  
      'title' => '⇠.rtl',  
      'block' => 'blockquote',  
      'classes' => 'rtl',
      'wrapper' => true,
    ),
    array(  
      'title' => '.ltr⇢',  
      'block' => 'blockquote',  
      'classes' => 'ltr',
      'wrapper' => true,
    ),
  );
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
}
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'njimedia_setup_mce_before_init_insert_formats' ); 


/**
 * Filter to make all uploaded files have lowercased name in file system.
 * This was added because Mac OS file systems are case-insensitive by default
 * which causes issues with the git repos
 */
function njimedia_setup_make_filename_lowercase($filename) {
    $info = pathinfo($filename);
    $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name = basename($filename, $ext);
    return strtolower($name) . $ext;
}
add_filter('sanitize_file_name', 'njimedia_setup_make_filename_lowercase', 10);

function njimedia_setup_mce4_options($init) {
  $default_colours = '"702082", "Purple",
                      "000000", "Black",
                      "efeede", "Tan",
                      "c8d7df", "Light Blue",
                      "d8dbd8", "Light Gray",
                      "d9e6dc", "Light Green",
                      "ddd0cf", "Pink",
                      "ffffff", "White",
                      "800000", "Maroon",
                      "FF6600", "Orange",
                      "808000", "Olive",
                      "008000", "Green",
                      "008080", "Teal",
                      "0000FF", "Blue",
                      "666699", "Grayish blue",
                      "808080", "Gray",
                      "FF0000", "Red",
                      "FF9900", "Amber",
                      "99CC00", "Yellow green",
                      "339966", "Sea green",
                      "33CCCC", "Turquoise",
                      "3366FF", "Royal blue",
                      "800080", "Purple",
                      "999999", "Medium gray",
                      "FF00FF", "Magenta",
                      "FFCC00", "Gold",
                      "FFFF00", "Yellow",
                      "00FF00", "Lime",
                      "00FFFF", "Aqua",
                      "00CCFF", "Sky blue",
                      "993366", "Red violet",
                      "FFFFFF", "White",
                      "FF99CC", "Pink",
                      "FFCC99", "Peach",
                      "FFFF99", "Light yellow",
                      "CCFFCC", "Pale green",
                      "CCFFFF", "Pale cyan",
                      "99CCFF", "Light sky blue",
                      "CC99FF", "Plum"';

  $custom_colours =  '"E14D43", "Color 1 Name",
                      "D83131", "Color 2 Name",
                      "ED1C24", "Color 3 Name",
                      "F99B1C", "Color 4 Name",
                      "50B848", "Color 5 Name",
                      "00A859", "Color 6 Name",
                      "00AAE7", "Color 7 Name",
                      "282828", "Color 8 Name"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'njimedia_setup_mce4_options');



function njimedia_setup_custom_fonts() {
  echo '<style>
    .mce-container * {
      max-height: 400px;
    } 
  </style>';
}
add_action('admin_head', 'my_custom_fonts');

// Add CSS to Visual Editor
add_editor_style('assets/css/styles.css');
