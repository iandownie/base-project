<?php
$slides = $options['data'];
if( ! empty($slides) ){
	$options['classes']['section'] .= ' carousel-buttons ';
	$options['template'] = '01_atoms/wrapper-start.php';
	$options = load_content( $options );
	foreach ($slides as $key => $slide) {
		$data = 'data-slide="'.$slide['id'].'"';
		$content = $slide['counter'];
		$classes = ' controller -absolute can-tab bold ';
		if( '01' === $slide['counter'] ){
			$classes .= ' active -first ';
		}
		if($key+1 === count($slides)){
			$classes .= ' -last ';
		};
		print wrap_content($content, $classes, $data);
	}
	$options['template'] = '01_atoms/wrapper-end.php';
	$options = load_content( $options );
}
