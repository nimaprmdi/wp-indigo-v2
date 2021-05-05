<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-single'); ?>>



    <section class="c-single__entry-content">

        <div class="c-single__thumbnail">
            <?php the_post_thumbnail( 'full' ); ?>
        </div>

        <div class="c-single__content">
            <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-indigo' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );
            ?>
        </div>

        <div class="c-single__tags">
            <?php wp_indigo_get_custom_category('' , 'c-single__tag h6 u-letter-space-regular'); ?>
        </div>

        <?php if ( 'portfolios' != get_post_type() ){ ?>

        <div class="c-single__share">
            <?php wp_indigo_share_links(); ?>
        </div>

        <?php } ?>

    </section><!-- c-single__entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->