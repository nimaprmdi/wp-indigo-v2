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

    <section class="c-single__entry-header">

        <div class="c-single__entry-header__content">

            <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="c-single__entry-title u-letter-space-medium">', '</h1>' );
                else :              
                    the_title( '<h2 class="c-single__entry-title u-letter-space-medium"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;		            
            ?>

            <div class="c-single__entry-meta">

                <div class="c-single__author">
                    <div class="c-single__author__avatar">
                        <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
                    </div>

                    <div class="c-single__author__info">
                        <?php wp_indigo_posted_by("c-single__author__link"); ?>
                    </div>
                </div>

                <span class="u-ellipse"></span>

                <div class="c-single__date">
                    <span class="h6 u-letter-space-regular">
                        <a href="<?php echo esc_url( get_permalink() ) ?>">
                            <?php echo esc_html( get_the_date( "M d, Y" ) ) ?>
                        </a>
                    </span>
                </div><!-- c-single__date -->

            </div>

        </div><!-- c-single__entry-meta -->

    </section><!-- c-single__entry-header -->

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