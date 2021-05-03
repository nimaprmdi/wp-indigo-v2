<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 * 
 */
if (!is_active_sidebar( 'sidebar-1' )){
	return;
}
?>
<aside id="secondary" class="c-widget widge-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->