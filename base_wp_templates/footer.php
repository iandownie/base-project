<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Web_Point
 * @since Web_Point 2017 1.0
 */
 $copyright = '';
 if(! empty(get_field('copyright', 'options'))){
	$copyright = get_field('copyright', 'options');
 }
?>
	<footer class='background -gray-dark justify -space-between -align-items-center '>
		<div class='left'><span class='color -text uppercase bold'>Copyright &copy; <?php print date("Y"); ' '.$copyright; ?></span></div>
	</footer>
	<?php wp_footer(); ?>
	<script>
	AOS.init({
		easing: 'ease-in-out-sine'
	});
	</script>
</body>
</html>