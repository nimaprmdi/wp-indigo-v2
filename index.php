<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */
get_header();
?>

<main id="primary" class="c-main site-main">

    <header class="c-main__header">

        <h1 class="c-main__page-title"><?php esc_html_e( 'Blog', 'wp-indigo' ); ?></h1>

        <div class="c-main__category">
            <?php wp_indigo_category_filter("c-main__cat h3 h3--normal" , "" , true  ); ?>
        </div>

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