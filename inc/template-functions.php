<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wp-indigo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_indigo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wp_indigo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_indigo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wp_indigo_pingback_header' );



function wp_indigo_typography() {
	
	if ( get_theme_mod( 'typography_primary_color' ) == "" ) {
		$wp_indigo_primary_color = "#1A1A1A";
	} else {
		$wp_indigo_primary_color = get_theme_mod( 'typography_primary_color' );
	}
	if ( get_theme_mod( 'typography_secondary_color' ) == "" ) {
		$wp_indigo_secondary_color = "#555555";
	} else {
		$wp_indigo_secondary_color = get_theme_mod( 'typography_secondary_color' );
	}
	if ( get_theme_mod( 'wp_indigo_tertiary-color' ) == "" ) {
		$wp_indigo_tertiary_color = "#C4C4C4";
	} else {
		$wp_indigo_tertiary_color = get_theme_mod( 'wp_indigo_tertiary-color' );
	}
	if ( get_theme_mod( 'wp_indigo_quaternary-color' ) == "" ) {
		$wp_indigo_quaternary_color = "#3F51B5";
	} else {
		$wp_indigo_quaternary_color = get_theme_mod( 'wp_indigo_quaternary-color' );
	}
	
	$html = ':root {	
	            --wp_indigo_primary-color: '.$wp_indigo_primary_color.';
	            --wp_indigo_secondary-color: '.$wp_indigo_secondary_color.';
				--wp_indigo_tertiary-color: '.$wp_indigo_tertiary_color.';
				--wp_indigo_quaternary-color: '.$wp_indigo_quaternary_color.';
			}';
			
	return $html;
	
}

add_action( 'admin_head', 'wp_indigo_theme_settings' );
add_action( 'wp_head', 'wp_indigo_theme_settings' );

function wp_indigo_theme_settings() {
	$wp_indigo_theme_typography = wp_indigo_typography();

	?>
<style>
<?php echo esc_html($wp_indigo_theme_typography);
?>
</style>
<?php
}