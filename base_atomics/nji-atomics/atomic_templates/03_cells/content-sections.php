<?php
/*
 *  This file handles how each different content section is handled. Add each content section type you make for the site into the swtich below.
 */

// Each content section is added to this array in order to build a list of cotent section IDs so allow links to be built that wil navigate users to any specific content section
global $verticalNav;
if ( empty( $verticalNav ) ) {
	$verticalNav = array();
}

global $post;

// $location holds a string, either a post ID or option's page name, which allows ACF to get data from that post or option's page.
$location = $options['post'];
if ( have_rows( 'content_sections', $location ) ) {
	$i = 0;

	//Loop through all content sections
	while ( have_rows( 'content_sections', $location ) ) : the_row();
		$options['row'] = get_field('content_sections')[$i];
		$i++;

		// Assign Sections Anchor IDs.
		$anchor_id = 'anchor-' . count( $verticalNav );
		$options['id']['section'] = $anchor_id;

		// Uncommenting these makes all section elements have the AOS animation
		// $options['attributes']['section'] .= ' data-aos="fade-up" ';
		// $options['classes']['inner'] = ' aos-item__inner ';

		// Gives each content section a class name matching it's content section type
		$options['classes']['section'] .= ' -'.get_sub_field( 'content_selector' ).' ';
		switch ( get_sub_field( 'content_selector' ) ) {
			case 'hero':
				// Start Hero Section
				$transparentSections = 0;
				$options['attributes']['section'] .= 'data-timing="'.get_sub_field('slide_timing').'000"';
				$options['data'] = 'hero_instances';
				$options['template'] = '03_cells/carousel.php';
				$options = load_content( $options );
				// End Hero Section
				break;
			case 'grid_feed':
				// Start Hero Section
				$options['template'] = '02_molecules/grid-feed.php';
				$options = load_content( $options );
				// End Hero Section
				break;
			case 'generic':
				// Start Generic Section.
				$horizontal_alignment = get_sub_field('generic_horizontal_alignment');
				$vertical_alignment = get_sub_field('generic_vertical_alignment');
				$options['attributes']['inner'] = ' style="background-color: '.get_sub_field('generic_background_color').';"';
				$options['text'] = get_sub_field('generic_content');
				$options['classes']['section'] .= " justify $horizontal_alignment ";
				$options['classes']['container'] = " justify -column $vertical_alignment ";
				$options['template'] = '02_molecules/section.php';
				$options = load_content( $options );
				// End Generic Section
				break;
			default:
		}

		// This array can be used to build a vertical navigation menu to allow users to navigate up and down the page to each content section
		if ( ! empty( $section_heading ) ) {
			$navData = array(
				'anchorId' => $anchor_id,
				'title' => $section_heading,
			);
			array_push( $verticalNav, $navData );
		}
	endwhile;
}
