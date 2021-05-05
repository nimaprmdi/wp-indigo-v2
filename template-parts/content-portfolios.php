<?php
/**
 * 
 * Template part for Displaying Portfolios Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-post c-post--portfolios'); ?>>
    <div class="c-post__thumbnail">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <a class="c-post__link" href="<?php echo esc_url(get_permalink())  ?>">
        <div class="c-post__entry-meta">
            <?php
                the_title( '<h2 class="c-post__entry-title">', '</h2>' );
            ?>
            <div class="c-post__category">
                <?php wp_indigo_get_taxonomy( "portfolio_category" , "c-post__cat u-link--secondary h6"  , "span" , ", " ); ?>
            </div>
        </div>
    </a>
</article><!-- #post-<?php the_ID(); ?> -->