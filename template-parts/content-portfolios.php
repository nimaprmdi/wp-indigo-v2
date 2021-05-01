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

    <div class="c-post__entry-meta">

        <?php
            if ( is_singular() ) :
                the_title( '<h2 class="c-post__entry-title">', '</h2>' );
            else :              
                the_title( '<h2 class="c-post__entry-title"><a class="c-post__entry-title-link"  href="'. esc_url(get_permalink()) .'" rel="bookmark">', '</a></h2>' );
            endif;         
        ?>

        <div class="c-post__category">
            <?php wp_indigo_get_taxonomy( "portfolio_category" , "c-post__cat a--secondary h6" ); ?>
        </div>

    </div>

</article><!-- #post-<?php the_ID(); ?> -->