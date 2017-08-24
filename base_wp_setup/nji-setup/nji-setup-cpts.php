<?php
/**
* Register Custom Post Types
*/

// Hooks
// add_action( 'init', 'nji_custom_post_type_careers' );


// add_filter('query_vars', 'parameter_queryvars' );


function parameter_queryvars( $qvars ) {
	$qvars[] = 'articles';
	return $qvars;
}

// Register 'Careers' Post Type.
function nji_custom_post_type_careers(){
	$labels = nji_custom_labels_post_types( 'Career', 'Careers' );
	$args = array(
		'labels'		=> $labels,
		'show_in_rest'	=> true,
		'description'	=> 'Job Openings',
		'menu_icon' => 'dashicons-hammer',
		'extras'    => array( 'title_placeholder_text' => 'Job Title' ),
		'public'		=> true,
		'menu_position'	=> 5,
		'rewrite'		=> array( 'slug' => 'careers' ),
		'supports'		=> array( 'thumbnail','title', 'editor' )
	);
	register_post_type( 'careers', $args );
	// Bind Type-specific Custom Taxonomies to this Custom Post Type
	register_taxonomy_for_object_type( 'project_type', 'project' );
}


/**
 * Helper Functions
 */
function nji_custom_labels_post_types( $singular, $plural ){
	$labels = array(
		'name'					=> $plural,
		'singular_name'			=> $singular,
		'menu_name'				=> $plural,
		'add_new'				=> 'Add New ',
		'add_new_item'			=> 'Add New ' . $singular,
		'new_item'				=> 'New ' . $singular,
		'edit_item'				=> 'Edit ' . $singular,
		'update_item'			=> 'Update ' . $singular,
		'view_item'				=> 'View ' . $singular,
		'all_items'				=> 'All ' . $plural,
		'search_items'			=> 'Search ' . $plural,
		'parent_item_colon'		=> 'Parent ' . $singular . ': ',
		'not_found'				=> 'No ' . $plural . ' found',
		'not_found_in_trash'	=> 'No ' . $plural . ' found in Trash.',
	);
	return $labels;
}