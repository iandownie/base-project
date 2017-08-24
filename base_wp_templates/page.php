<?php
/**
 * Template Name: Default Template
 * @package WordPress
 * @subpackage Web_Point
 * @since Web_Point 2017 1.0
 * Default page tempalte for Web_Point's 2017 site.
 */
get_header();
global $post;

// Start Custom Content Sections
$options['post'] = $post;
$options['template'] = '03_cells/content-sections.php';
$options = load_content( $options );
// end Custom Content Sections

get_footer();