<?php
/**
* Plugin Name: &#9634; NJI Site Structures
* Description: Site-specific content structures and back-end customizations including custom Post Types, custom Taxonomies, and ACF-generated fieldgroup definitions.
* Version: 1.0
* Author: idownie
* Author URI: https://www.njimedia.com/
*/

// Make sure we don't expose any info if called directly.
if ( ! function_exists( 'add_action' ) ) {
	exit;
}

// Custom Post Types.
require_once( 'nji-setup/nji-setup-cpts.php');

// Custom Taxonomies.
require_once( 'nji-setup/nji-setup-taxonomies.php');

// Custom Functionality
require_once( 'nji-setup/nji-functionality.php');