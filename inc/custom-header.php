<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package wp-indigo
 */


if ( ! function_exists( 'wp_indigo_branding' ) ) :
	/**
	 * Display Custom logo if exist otherwise show site title
	 */
	function wp_indigo_branding() {
		
		?>
<h1 class="c-header__title site-title">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</h1>
<?php 
		
	}
endif;