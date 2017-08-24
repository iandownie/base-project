<?php
/*
 * Template for building a single hero image, with optional text.
 *
 * $options['data'] = current hero ID, if there are multiple heroes.
 */

$options['classes']['img'] .= ' -hero ';
$options['classes']['section'] .= ' hero ';
$options['classes']['container'] .= ' justify -column ';
$options['template'] = '02_molecules/section.php';
$options = load_content($options);