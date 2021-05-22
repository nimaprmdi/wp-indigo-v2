<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 * 
 */
if (!is_active_sidebar( 'primary-sidebar' )){
	return;
}
?>
<aside id="secondary" class="c-widget widge-area">
    <?php dynamic_sidebar( 'primary-sidebar' ); ?>


    <!-- qa- -->
    <section id="search-2" class="widget widget_search">

    <?php if( true == get_theme_mod( 'sidebar_related_tags', true ) ) : ?>
        <h2 class="widget-title"><?php echo esc_html__( 'Tags', 'wp-indigo' )?></h2>
        <ul>
            <?php wp_indigo_get_custom_category_list(); ?>
        </ul>
    <?php endif; ?>

    </section>
    <!-- qa- -->

</aside><!-- #secondary -->