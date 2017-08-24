<?php
/**
 * Render link markup.
 *
 * @package Wordpress
 * @subpackage NJI Atomics 1.0
 */
?>
<a <?php print $options['attributes']; ?> class="can-tab <?php print $options['classes']['link']; ?>" href="<?php print $options['url']; ?>"><?php print $options['text']; ?></a>