<?php

  // this may be set already in wp-config. but if not, define it and default to FALSE
if( !defined('NJIMEDIA_DEBUG') ) define('NJIMEDIA_DEBUG', is_dev_server());

register_activation_hook(__FILE__, 'njimedia_plugin_activated');

add_action( 'after_setup_theme', 'njimedia_default_attachment_display_settings' );
add_action( 'init', 'njimedia_init' );


if( defined('NJIMEDIA_DEBUG') && NJIMEDIA_DEBUG && ! is_admin() ){
  include_once( plugin_dir_path( __FILE__ ) . 'nji-debug.php' );
}


// site options via Custom Field Suite
include_once( plugin_dir_path( __FILE__ ) . 'nji-configs/nji-options-pages.php' );
include_once( plugin_dir_path( __FILE__ ) . 'nji-configs/nji-shortcodes.php' );



function is_dev_server(){
  if( isset($_SERVER['HTTP_HOST'])) {
    return  1 === preg_match('/\.dev|\.loc/', strtolower($_SERVER['HTTP_HOST']));
  }else{
    return false;
  }
}

// Check if we're running on user's local machine, vagrant or otherwise.
// For now, equivalent to is_dev_server(), but in future may want to distinguish
// between staging and local.
function is_local_server() {
  if( isset($_SERVER['HTTP_HOST'])) {
    return  1 === preg_match('/\.dev|\.local|\.loc/', strtolower($_SERVER['HTTP_HOST']));
  }else{
    return false;
  }
}

  /**
   * Wordpress 'init' action hook.
   * Runs after WordPress has finished loading but before any headers are sent. Useful for intercepting $_GET or $_POST triggers
   * N.B.: Also load_plugin_textdomain calls should be made during init, otherwise users cannot hook into it.
   */
function njimedia_init(){
  include_once( plugin_dir_path( __FILE__ ) . 'nji-configs/nji-admin-utilities.php' );
  // add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
  add_action( 'pre_get_posts', 'njimedia_pre_get_posts_hook' );
}


  /**
   * Set the Attachment Display Settings "Link To" default to "none"
   *
   * This function is attached to the 'after_setup_theme' action hook.
   */
function njimedia_default_attachment_display_settings() {
	update_option( 'image_default_align', 'left' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'large' );
}

  /**
   * njimedia_pre_get_posts_hook - modify the query in some situations.
   * @param class[WP_QUERY] $query - the typical WP_Query class
   */
function njimedia_pre_get_posts_hook( $query ){
    global $wp_query;

    // ONLY ACT ON MAIN QUERY
    if( !$query->is_main_query() ) return;

    $post_type = $query->get( 'post_type' );
    $isAdmin = is_admin();


    // sort newest first
    if( !$isAdmin && $wp_query->is_posts_page ){
        $query->set( 'order', 'DESC' );
    }

    // show all posts
    // if( $post_type === 'comment_letter' )
    // {
    //     $query->set( 'posts_per_page', -1 );
    // }
}

/**
 * Load any styles needed for Admin
 */
function load_custom_wp_admin_style($hook) {
	//wp_enqueue_script('njimedia-admin-main',  get_template_directory_uri() . '/assets/js/main-admin.js' );
}

  /**
   * check if current post is of a given type
   *
   * @param mixed string or array of strings with post type names to check
   * @return boolean true if current post's type matches arg
   */
function is_post_type($type){
  $t = is_array($type) ? $type : array($type);
  $curr_type = get_post_type();
  foreach($t as $oneType){
    if( $oneType == $curr_type )
      return true;
  }
  return false;
}

  /**
   * return array of category names for current post. Must be called in the loop
   *
   * @return array    possibly zero-lengthed array of category names
   */
function njimedia_post_cat_names()
{
    global $post;
    $post_cats = get_the_category( );
    $cats = array();
    if($post_cats){
        foreach($post_cats as $category){
            array_push($cats, $category->name);
        }
    }
    return $cats;
}


/**
 * bottleneck for debugging / logging code
 */
function njimedia_debug($msg){
	if( NJIMEDIA_DEBUG ){
		error_log(print_r($msg,true));
	}
}
?>
