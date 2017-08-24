<?php
/**
 * Render "More" Link Button.
 *
 * @package Wordpress
 * @subpackage NJI Atomics 1.0
 */

// If no url, no button.
if ( empty( $options['url'] ) ) {
	return;
}

// If class includes "-bottom", add a spacer element.
if ( strpos( $options['classes']['button'], '-bottom' ) ) {
	print '<div class="btn-spacer"></div>';
}

// Print the button.
printf(
	'<a href="%s" class="can-tab btn %s">%s</a>',
	esc_url( $options['url'] ),
	esc_attr( $options['classes']['button'] ),
	esc_html( $options['button'] )
);
