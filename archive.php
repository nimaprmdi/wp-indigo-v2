<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */

get_header();
?>
<main id="primary" class="c-main site-main">

    <header class="c-main__header">
        <h1 class="c-main__page-title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
    </header>

    <section class="c-main__content">
        <?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :

					the_post();
					get_template_part( 'template-parts/content' );
					
				endwhile;

				wp_indigo_get_default_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

		?>
    </section>

</main><!-- #main -->

<?php
get_footer();