<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp-indigo
 */

get_header();
?>

<main id="primary" class="c-main c-main--wide site-main">

    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );
			
			
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;// End of the loop.
	?>

</main><!-- #main -->

<?php
if ( 'portfolios' != get_post_type() ){
	get_sidebar();
}
get_footer();