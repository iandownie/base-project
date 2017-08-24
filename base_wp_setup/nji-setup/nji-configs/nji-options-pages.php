<?php

namespace Roots\Sage\ACF;

/* --------------------------------------------------------------------------------------------
 *    CheatSheet for using PHP namespaces.
 *    ====================================
 *
 * * action/filter callbacks:
 *      add_filter( 'init', __NAMESPACE__ . "\\my_init_function" );
 *
 * * call function in this file from a template:
 *      Roots\Sage\Custom\your_func( ... );
 *
 * * with 'use <namespace>'
 *    use Roots\Sage\Config;
 *    Config\display_sidebar()
 * --------------------------------------------------------------------------------------------
 */

add_action( 'init', __NAMESPACE__ . '\\acf_site_options_init' );

/**
 * Create ACF Site Options page
 *
 * see: http://www.advancedcustomfields.com/resources/options-page/
 * for more info or example of adding sub menus
 */
function acf_site_options_init() {
  if ( function_exists( 'acf_add_options_page' ) ) {

    // global site options menu/settings
    acf_add_options_page(array(
      'position'    => 50,
      'page_title'  => 'Site Configuration',
      'menu_title'  => 'Site Configuration',
      'menu_slug'   => 'site-configs',
      'capability'  => 'edit_posts',
      'redirect'    => false,
    ));

    /*
      acf_add_options_sub_page(array(
        'page_title'  => 'Theme Footer Settings',
        'menu_title'  => 'Footer',
        'parent_slug' => 'theme-general-settings',
      ));
    */

  }
}

// Adds admin page for home page options
// add_action( 'init', __NAMESPACE__ . '\\acf_home_page_options_init' );
// function acf_home_page_options_init() {
// 	if ( function_exists( 'acf_add_options_page' ) ) {
// 		acf_add_options_page(array(
// 			'position'		=> 3,
// 			'icon_url'		=> 'dashicons-admin-home',
// 			'page_title'	=> 'Home Page Settings',
// 			'menu_title'	=> 'Home Page',
// 			'menu_slug'		=> 'home-page-settings',
// 			'capability'	=> 'edit_posts',
// 			'redirect'		=> false,
// 		));
// 	}
// }