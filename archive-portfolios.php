<?php
/**
 * 
 * The template for displaying archive Portfolios
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 * 
 */
get_header();
?>


<main id="primary" class="c-main c-main--portfolios site-main">
    <header class="c-main__header">

        <h1 class="c-main__page-title"><?php esc_html_e( 'Portfolio', 'wp-indigo' ); ?></h1>

        <div class="c-main__category">
            <a class="c-main__cat h3 h3--normal" href=<?php echo site_url()."/".esc_html( get_post_type()) ?>>
                <?php esc_html_e( 'All ', 'wp-indigo' ); ?>
            </a>

            <?php wp_indigo_taxonomy_filter("c-main__cat h3 h3--normal" , "" , false , "portfolio_category");?>
        </div>

    </header><!-- c-main__header -->

    <section class="c-main__content">
        <?php
        
			if ( have_posts( have_posts() ) ) :
				/* Start the Loop */
                echo '<div class="c-main__portfolios">';
                
				while ( have_posts() ) :

					the_post();                    
                    
					get_template_part( 'template-parts/content' , 'portfolios' );
					
				endwhile;

                echo '</div>';
                
				wp_indigo_get_default_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>
    </section>
    <!-- c-main__content -->

</main><!-- #main -->

<?php
get_footer();