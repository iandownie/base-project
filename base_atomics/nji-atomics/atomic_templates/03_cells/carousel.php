<?php
/*
 * Template for building a carousel of hero images, with optional text.
 *
 * $options['data'] = Field name containing hero content data
 * $options['row'] = current Content Section data
 */
if( have_rows($options['data']) ):
	$field_name = $options['data'];
	if( count($options['row'][$options['data']]) > 1 ) {
		$counter = 1;
		$options['id']['section'] = $field_name.'-'.$counter;
		$slides = array();
		$options['classes']['section'] .= ' carousel ';
		$options['classes']['container'] .= ' -carousel ';
	}

	$options['classes']['section'] .= " $field_name ";
	$options['template'] = '01_atoms/wrapper-start.php';
	$options = load_content( $options );
	while( have_rows($field_name) ): the_row();
		if ( ! empty($counter)){ 
			$visual_counter = '0'.$counter;
			if( $counter > 9 ){
				$visual_counter = $counter;
			}
		}
		if( is_array(get_row()) ){
			if( ! empty( get_sub_field('image') || ! empty( get_sub_field( 'heading' ) ||  ! empty( get_sub_field( 'text' )) ) ) ){
				if ( ! empty( get_sub_field('text') ) ){
					$options['text'] = get_sub_field('text');
				}
				if ( ! empty($counter)){ 
					if( empty($options['text'])){
						$options['text'] = '<b class="no-text">'.$visual_counter.'</b>';
					} else {
						$options['text'] = '<b>'.$visual_counter.'</b><div class="line"></div>'.$options['text'];
					}
					$options['data'] = uniqid('hero_');
					$options['classes']['text'] .= ' pre-heading capitalize justify ';
					$options['classes']['section'] .= ' slide '.$options['data'].' ';
					$current_hero = array(
						'id' => $options['data'],
						'counter' => $visual_counter
					);
					array_push($slides, $current_hero);
				}
				if ( ! empty(get_sub_field('image')) ){
					$options['img'] = get_src_set( get_sub_field('image'),  '100vw' );
				} else {
					$options['img'] = get_src_set( get_field('default_image', 'options'),  '100vw' );
				}
				$options['classes']['section'] .= " hero ";
				if ( ! empty( get_sub_field('heading') ) ){
					$options['heading'] = get_sub_field('heading');
					$options['classes']['heading'] .= ' capitalize bold ';
				}
				$options['sub_heading'] = '<div class="hand"></div>';
				$options['classes']['sub_heading'] = ' clock ';
				$options['classes']['inner'] .= ' justify -column -reverse -space-around ';
				$options['template'] = '02_molecules/hero.php';
				$options = load_content( $options );
			}
		} else {
			$slide_id = njimedia2017_build_reference_slide(get_post(get_row()));
			array_push($slides, array('id'=> $slide_id, 'counter' => $visual_counter));
		}
		$counter ++;
	endwhile;
	if( ! empty($slides) ){
		$options['data'] = $slides;
		$options['template'] = '03_cells/carousel-buttons.php';
		$options = load_content( $options );
	}
	$options['template'] = '01_atoms/wrapper-end.php';
	$options = load_content( $options );
endif;