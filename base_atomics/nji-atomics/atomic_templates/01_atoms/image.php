<?php
/**
 * Render image markup.
 *
 * @package Wordpress
 * @subpackage NJI Atomics 1.0
 */
if ( ! is_string( $options['img'] ) ) {
	error_log( 'Non-string passed to image.php template for $options[\'img\'] value.' );
} else {
	echo "<img class='img "
		. esc_attr( $options['classes']['img'] )
		. "' "
		. $options['img']
		. "title='"
		. esc_attr( $options['heading'] )
		."'>";
}
