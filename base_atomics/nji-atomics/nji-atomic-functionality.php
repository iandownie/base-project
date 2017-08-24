<?php
/**
 * Uses the $option variable to load content with the appropriate template
 */
function set_default_options() {
	$options = array(
		'button' => 'Learn More',
		'directory' => $_SERVER['DOCUMENT_ROOT'] . '/wp-content/mu-plugins/nji-atomics/atomic_templates/',
		'post' => '',
		'file' => '',
		'heading' => '',
		'sub_heading' => '',
		'text' => '',
		'url' => '',
		'title' => '',
		'attributes' => array(
			'section' => '',
			'container' => '',
			'inner' => '',
		),
		'classes' => array(
			'text' => '',
			'heading' => '',
			'button' => '',
			'section' => '',
			'hero' => '',
			'link' => '',
			'date' => '',
			'item' => '',
			'select' => '',
			'img' => '',
			'icon' => '',
			'background' => '',
			'sub_heading' => '',
			'footer' => '',
			'container' => '',
			'carousel' => '',
			'video' => '',
			'inner' => '',
		),
		'id' => array(
			'text' => '',
			'heading' => '',
			'button' => '',
			'section' => '',
			'hero' => '',
			'link' => '',
			'date' => '',
			'carousel' => '',
			'container' => '',
		),
		'break_points' => array(
			'min' => array(
				'desktop' => '1025',
				'tablet' => '640',
			),
			'max' => array(
				'tablet' => '1024',
				'mobile' => '639',
			),
			
		),
		'data' => array(),
		'slides' => array(),
		'options' => array(),
		'annotations' => array(),
	);
	return $options;
}

$options = set_default_options();

function load_content( $options ) {
	if( defined('NJIMEDIA_DEBUG') && NJIMEDIA_DEBUG && ! is_admin() ){
		print '<!-- THEME DEBUG -->';
		$destination = $options['directory'].$options['template'];
		print "<!-- START OUTPUT from ".$destination." -->";
	}
	include $options['directory'] . $options['template'];
	if( defined('NJIMEDIA_DEBUG') && NJIMEDIA_DEBUG && ! is_admin() ){
		print "<!-- END OUTPUT from ".$destination." -->";
	}
	unset( $options );
	$options = set_default_options();
	return $options;
}

/**
 * Setup image data to create source sets:
 * Example Usage:
 * $image_sizes = '100vw';
 * $reponsive_image = get_src_set(get_field('hero'), $image_sizes);
 * $options['img'] = $reponsive_image;
 */
function get_src_set( $image_array, $image_sizes ) {
	$all_sizes = get_intermediate_image_sizes();
	$sizes = array_filter( $all_sizes, function( $i ) {
		return ( 'thumbnail' !== $i && 'alm-thumbnail' !== $i );
	});
	if( ! is_array($image_array)){ // Gets Featured Image array if sent an image ID. Basically, can turn Featured Images into ACF image arrays.
		$id = $image_array;
		$image_array = array(
			'sizes' => array(),
			'caption' => '',
			);
		foreach ($sizes as $key => $size) {
			$image_array['sizes'][$size] = wp_get_attachment_image_src($id, $size)[0];
			$image_array['sizes'][$size.'-width'] = wp_get_attachment_image_src($id, $size)[1];
			$image_array['sizes'][$size.'-height'] = wp_get_attachment_image_src($id, $size)[2];
		}
		$image_array['url'] = wp_get_attachment_image_src($id, 'full')[0];
	}

	if ( empty($image_array) ){
		return;
	}
	$caption = esc_attr( $image_array['caption'] );
	$sources = array();
	$maximum = 0;
	foreach ( $sizes as $key => $size ) {
		if ( $image_array['sizes'][ $size . '-width' ] > $maximum ){
			$maximum = $image_array['sizes'][ $size . '-width' ];
		}
		array_push(
			$sources,
			$image_array['sizes'][ $size ] . ' ' . $image_array['sizes'][ $size . '-width' ] . 'w'
		);
		if ( end( $sizes ) === $size ) {
			$original = ( $maximum + 100 );
			array_push(
				$sources,
				$image_array['url'] . ' ' . $original . 'w'
			);
		}
	}
	$src_set = implode( ',', $sources );
	$img = $image_array['url'];
	$responsive_image = "title=\"$caption\" src=\"$img\" srcset=\"$src_set\" sizes=\"$image_sizes\"";
	return $responsive_image;
}

/*
 * Return src_set attribute content for featured images
 */

function get_featured_src_set($post = null){
	$post = get_post( $post );
	if ( ! $post ) {
		return '';
	}
	$id = get_post_thumbnail_id( $post );
	if ( $id ) {
		$image_array = array(
			'sizes' => array(),
			'caption' => '',
			);
		foreach(get_intermediate_image_sizes() as $key => $size){
			$image_array['sizes'][$size] = wp_get_attachment_image_src($id, $size)[0];
			$image_array['sizes'][$size.'-width'] = wp_get_attachment_image_src($id, $size)[1];
			$image_array['sizes'][$size.'-height'] = wp_get_attachment_image_src($id, $size)[2];
		}
		$image_array['url'] = wp_get_attachment_image_src($id, 'full')[0];
		$src_set = implode( ',', $sources );
		$img = $image_array['url'];
		$responsive_image = "title=\"$caption\" src=\"$img\" srcset=\"$src_set\" sizes=\"$image_sizes\"";
		return $responsive_image;
	}
}

/**
 * Builds preview image styles.
 *
 * @param String $image	ACF image field data array.
 */
function get_preview( $image ) {
	return 'style="background-image: url('.$image['sizes']['tiny-preview'].'); background-repeat: no-repeat; background-size: cover; background-position: center;"';
}

// Adds image size
// This tiny-preview size is meant to only be used to display preview images nearly instantaneously while full size images are still loading.
add_action( 'after_setup_theme', 'nji_media_image_sizes' );
function nji_media_image_sizes() {
	add_image_size( 'tiny-preview', 10, 5 );
}


/**
 * Super simple builder functions
 */
function wrap_content( $content, $wrapper_class = '', $other = '', $element = 'div'){
	return  "<$element $other class='$wrapper_class'>$content</$element>";
}
function build_link($content = '', $url = '', $classes = '', $other = ''){
	return "<a href='$url' class='can-tab $classes' $other >$content</a>";
}