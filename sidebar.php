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

<aside id="secondary" class="c-widget widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>

    <!-- qa- -->
    <div class="c-widget__item">

        <div class="c-widget__item">
            <h3 class="c-widget__title h2">Tags</h3>
            <?php wp_indigo_get_taxonomy_list('category' , 'c-widget__tag h6'); ?>
        </div>

    </div>

</aside><!-- #secondary -->