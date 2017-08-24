<?php
/*
 * This file puts the start and end of sections together. They can be built separately if you want to add content into the inner part of the section element.
 */

if ( ! empty( $options['text'] ) || ! empty( $options['heading'] ) || ! empty( $options['sub_heading'] ) || ! empty( $options['img'] ) || ! empty( $options['url'] )) :
	require $options['directory'] . '01_atoms/section-start.php';
	require $options['directory'] . '01_atoms/section-end.php';
endif;
