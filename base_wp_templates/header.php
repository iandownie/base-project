<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage NJIMedia 2017
 * @since NJIMedia 2017 1.0
 */

// If in a dev environment, this feeds out debug info on a page if a pagecheck query is added to the page.
if( isset($_GET['pagecheck']) ){
	NJIMEDIA_WP_Utils::page_check();
}
$options = set_default_options();

// Grabs custom favicon from  ACF on options page
if(! empty(get_field('favicon', 'options'))){
	$favicon = get_field('favicon', 'options');
}else{
	$favicon = get_template_directory_uri().'/assets/imgs/favicons/favicon.ico';
}

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="menu-toggle-parent">
<!--<![endif]-->
<head>
	<base href="/">
	<?php wp_head(); ?>
	<link rel="icon" href="<?php print $favicon; ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php print $favicon; ?>" type="image/x-icon" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="icon" href="<?php print $favicon; ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php print $favicon; ?>" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<!-- <script src="//use.typekit.net/sbp8yke.js"></script> -->
	<script>try{Typekit.load();}catch(e){}</script>
	<script>
		document.addEventListener("touchstart", function() {},false);
	</script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>

<body <?php body_class(); ?>>
	<header class='-main justify -space-between background -white'>
		<div class='left'>
		</div>
		<div class='right'>
		</div>
	</header>
