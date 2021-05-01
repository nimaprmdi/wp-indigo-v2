<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 */

?>

<footer id="colophon" class="c-footer site-footer">

    <div class="c-footer__wrapper">

        <div class="c-social-share c-social-share--footer">
            <?php wp_indigo_socials_links(false); ?>
        </div>

        <div class="c-footer__content">

            <div class="c-footer__site-info">
                <h5 class="c-footer__context">
                    <?php
                        /* translators: %s: Theme creator name by */
                        printf( esc_html__( 'WP-Indigo by', 'wp-indigo' ), 'wp-indigo' );
                    ?>
                </h5>
                <a class="c-footer__link h5"
                    href="<?php echo esc_url( __( 'https://vitathemes.com/', 'wp-indigo' ) ); ?>">

                    <?php 
                        /* translators: %s: Vita themes is the creator of the theme */
                        printf( esc_html__( 'VitaThemes ', 'wp-indigo' ) );
                    ?>

                </a>
                <span class="c-footer__context u-seprator"> | </span>
                <a class="c-footer__link h5" href="<?php echo esc_url( get_privacy_policy_url() ); ?>">

                    <?php
                        /* translators: 1: Privacy Policy Link */
                        printf( esc_html__( 'Privacy Policy', 'wp-indigo' ), 'wp-indigo');
                    ?>

                </a>
            </div><!-- .site-info -->

        </div>

    </div>

</footer><!-- #colophon -->

<?php wp_indigo_get_home_section_close_tag(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>