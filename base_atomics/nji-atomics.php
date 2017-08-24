<?php
/**
* Plugin Name: &#9634; NJI Atomics
* Description: Provides Atomic templating functionality.
* Version: 1.0
* Author: idownie
* Author URI: https://www.njimedia.com/
*/

// Make sure we don't expose any info if called directly.
if ( ! function_exists( 'add_action' ) ) {
	exit;
}

// Basic Functionality.
require_once( 'nji-atomics/nji-atomic-functionality.php');

// Atomic Rendering
require_once( 'nji-atomics/nji-atomic-classes.php');