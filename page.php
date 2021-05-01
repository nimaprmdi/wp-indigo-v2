<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */

get_header();
?>

<main id="primary" class="c-main site-main">

    <header class="c-main__header">
        <h1 class="c-main__page-title"><?php echo get_the_title(); ?></h1>
    </header>

    <section class="c-main__content c-main__content--page">
        <?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :

					the_post();
					get_template_part( 'template-parts/content', 'page' );
					
				endwhile;
				
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

		?>
    </section>

</main><!-- #main -->

<?php
get_footer();