<?php
/**
 * Builds a standardized section element
 * You fill out an $options array with data (the default array is found in nji-atomic-functionality.php) and the section is constructed according to that data
 */

$heading = $text = $sub_heading = $classes = '';
if ( ! empty( $options['heading'] ) ) {
	$classes = $options['classes']['heading'];
	$element = $options['elements']['heading'];
	$content = $options['heading'];
	$heading = "<$element class='$classes'>$content</$element>";
}
if ( ! empty( $options['text'] ) ) {
	$classes = $options['classes']['text'];
	$element = $options['elements']['text'];
	$content = $options['text'];
	$text = "<$element class='$classes'>$content</$element>";
}
if ( ! empty( $options['sub_heading'] ) ) {
	$element = $options['elements']['text'];
	$classes = $options['classes']['sub_heading'];
	$url = $options['url'];
	$content = $options['sub_heading'];
	if ( ! empty( $options['url'] ) ) {
		$sub_heading = "<$element class='$classes'><a href='$url'>$content</a></$element>";
	} else {
		$sub_heading = "<$element class='$classes'>$content</$element>";
	}
}
?>
<section id="<?php print $options['id']['section']; ?>" class="section content <?php print $options['classes']['section']; ?>" <?php print $options['attributes']['section']; ?>>
<?php
	// If an image is passed to this template, it is added in a way that makes it easy to use as a background image
if ( ! empty( $options['img'] ) ) {
	if ( empty( $options['classes']['img'] ) ){
		$options['classes']['img'] = ' -hero ';
	}
	include $options['directory'] . '01_atoms/image.php';
}
?>
	<div id="<?php print $options['id']['container']; ?>" class="container <?php print $options['classes']['container']; ?>" <?php print $options['attributes']['container']; ?>>
		<?php print $heading . $sub_heading . $text; ?>
		<div class="inner <?php  print $options['classes']['inner']; ?>" <?php print $options['attributes']['inner']; ?>>
<?php
// If a URL is added to the options array, this template will build a button.
if ( ! empty( $options['url'] ) ) {
	print '<div class="btn-container">';
	require $options['directory'] . '01_atoms/button.php';
	print '</div>';
}
?>
		</div>
