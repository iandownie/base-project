<?php
/**
* Register Custom Taxonomies.
*/

// add_action( 'init', 'nji_custom_taxonomy_teams' );


// Register 'Team' Taxonomy [legacy name: "Blog Type"] to 'Post' Type.
function nji_custom_taxonomy_teams() {
	$args = array(
		'show_in_rest' => true,
		'labels' => nji_custom_labels_taxonomies( 'Team', 'Teams' ),
		'hierarchical' => true,
		'show_tagcloud' => false,
	);
	register_taxonomy( 'teams', array( 'post', 'project', 'leaders' ), $args );
}

/**
 * Helpers
 */
function nji_custom_labels_taxonomies( $singular, $plural ){
	return array(
		'name' => $plural,
		'singular_name' => $singular,
		'search_items' => 'Search ' . $plural,
		'popular_items' => 'Popular ' . $plural,
		'all_items' => 'All ' . $plural,
		'parent_item' => 'Parent ' . $singular,
		'edit_item' => 'Edit ' . $singular,
		'update_item' => 'Update ' . $singular,
		'add_new_item' => 'Add New ' . $singular,
		'new_item_name' => 'New ' . $singular . ' Name',
	);
}