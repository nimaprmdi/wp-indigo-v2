<?php 
/**
 * 
 * Template Name: Home
 * 
 * The main template file for home page
 *
 * If this page doesn't exists index.php will show
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); 
?>


<section class="o-page__content o-page__content--center">

    <main id="primary" class="c-main site-main">

        <section class="c-main__content">

            <?php get_template_part( "template-parts/content" , "profile" ); ?>

        </section>

    </main><!-- #main -->


    <?php get_footer();