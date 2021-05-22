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
	if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
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
	
	/** Colors */
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
	if ( get_theme_mod( 'wp_indigo_tertiary_color' ) == "" ) {
		$wp_indigo_tertiary_color = "#C4C4C4";
	} else {
		$wp_indigo_tertiary_color = get_theme_mod( 'wp_indigo_tertiary_color' );
	}
	if ( get_theme_mod( 'wp_indigo_quaternary_color' ) == "" ) {
		$wp_indigo_quaternary_color = "#3F51B5";
	} else {
		$wp_indigo_quaternary_color = get_theme_mod( 'wp_indigo_quaternary_color' );
	}
	
	/* Font Family */
	if ( get_theme_mod( 'typography_headings_font' ) == "" ) {
		$wp_indigo_headings_font['font-family'] = "overpass";
	} else {
		$wp_indigo_headings_font = get_theme_mod( 'typography_headings_font' );
	}
	if ( get_theme_mod( 'typography_texts_font' ) == "" ) {
		$wp_indigo_texts_font['font-family'] = "sourceserifpro-regular";
	} else {
		$wp_indigo_texts_font = get_theme_mod( 'typography_texts_font' );
	}
	if ( get_theme_mod( 'typography_text_secondary_font' ) == "" ) {
		$wp_indigo_texts_secondary_font['font-family'] = "overpass-light";
	} else {
		$wp_indigo_texts_secondary_font = get_theme_mod( 'typography_text_secondary_font' );
	}


	$html = ':root {	
	            --wp_indigo_primary-color: '.$wp_indigo_primary_color.';
	            --wp_indigo_secondary-color: '.$wp_indigo_secondary_color.';
				--wp_indigo_tertiary_color: '.$wp_indigo_tertiary_color.';
				--wp_indigo_quaternary_color: '.$wp_indigo_quaternary_color.';

                --wp_indigo_headings_font: '. $wp_indigo_headings_font["font-family"] .';
				--wp_indigo_texts_font: '. $wp_indigo_texts_font["font-family"] .';
				--wp_indigo_texts_secondary_font: '. $wp_indigo_texts_secondary_font["font-family"] .';

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

function wp_indigo_show_avatar() {
	/**
	 * Display image fields
	 */
	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}

function wp_indigo_show_description() {
	/**
	 * Display Description
	 */
	if ( get_bloginfo( 'description' ) !== '' ) { 

		printf('<h4 class="description">');// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo  bloginfo( 'description' );
		printf( '</h4>' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

function wp_indigo_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'wp_indigo_dashicons', 999);



if( true == get_theme_mod( 'portfolios_control', true ) ) {
  /**
	* Check if portfolios Part is activated
	*/


  function wp_indigo_modify_libwp_post_type($postTypeName){
  /**
    * Modify LibWP post type name (If libwp plugin exist)
    */
	$postTypeName = 'portfolios';
	return $postTypeName;
  }  
  add_filter('libwp_post_type_1_name', 'wp_indigo_modify_libwp_post_type');

  
  function wp_indigo_modify_libwp_post_type_argument($postTypeArguments){  
  /**
	* Modify LibWP post type arguments (If libwp plugin exist)
	*/
	$postTypeArguments['labels'] = [
		'name'          => _x('Portfolios', 'Post type general name', 'wp-indigo'),
		'singular_name' => _x('Portfolio', 'Post type singular name', 'wp-indigo'),
		'menu_name'     => _x('Portfolios', 'Admin Menu text', 'wp-indigo'),
		'add_new'       => __('Add New', 'wp-indigo'),
		'edit_item'     => __('Edit Portfolio', 'wp-indigo'),
		'view_item'     => __('View Portfolio', 'wp-indigo'),
		'all_items'     => __('All Portfolios', 'wp-indigo'),
	];
	
	$postTypeArguments['rewrite']['slug'] = 'portfolios';
	$postTypeArguments['public'] = true;
	$postTypeArguments['show_ui'] = true;
	$postTypeArguments['menu_position'] = 5;
	$postTypeArguments['show_in_nav_menus'] = true;
	$postTypeArguments['show_in_admin_bar'] = true;
	$postTypeArguments['hierarchical'] = true;
	$postTypeArguments['can_export'] = true;
	$postTypeArguments['has_archive'] = true;
	$postTypeArguments['exclude_from_search'] = false;
	$postTypeArguments['publicly_queryable'] = true;
	$postTypeArguments['capability_type'] = 'post';
	$postTypeArguments['show_in_rest'] = true;
	$postTypeArguments['supports'] = array('title', 'editor' , 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields');
  
	return $postTypeArguments;
  }  
  add_filter('libwp_post_type_1_arguments', 'wp_indigo_modify_libwp_post_type_argument');
  
  

  function wp_indigo_modify_libwp_taxonomy_name($taxonomyName){
    /**
	* Modify LibWP taxonomy name (If libwp plugin exist)
	*/
	$taxonomyName = 'portfolio_category';
	return $taxonomyName;
	
  }
  add_filter('libwp_taxonomy_1_name', 'wp_indigo_modify_libwp_taxonomy_name');
  
  
  
  function wp_indigo_modify_libwp_taxonomy_post_type_name($taxonomyPostTypeName){
  /**
	* Modify LibWP taxonomy post type name (If libwp plugin exist)
	*/
	$taxonomyPostTypeName = 'portfolios';
	return $taxonomyPostTypeName;
  }
  add_filter('libwp_taxonomy_1_post_type', 'wp_indigo_modify_libwp_taxonomy_post_type_name');
  
  

  function wp_indigo_modify_libwp_taxonomy_argument($taxonomyArguments){
  /**
	* Modify LibWP taxonomy name (If libwp plugin exist)
	*/
	  $taxonomyArguments['labels'] = [
		'name'          => _x('Portfolio Categories', 'taxonomy general name', 'wp-indigo'),
		'singular_name' => _x('Portfolio Category', 'taxonomy singular name', 'wp-indigo'),
		'search_items'  => __('Search Portfolio Categories', 'wp-indigo'),
		'all_items'     => __('All Portfolio Categories', 'wp-indigo'),
		'edit_item'     => __('Edit Portfolio Category', 'wp-indigo'),
		'add_new_item'  => __('Add New Portfolio Category', 'wp-indigo'),
		'new_item_name' => __('New Portfolio Category Name', 'wp-indigo'),
		'menu_name'     => __('Portfolio Categories', 'wp-indigo'),
	];
	$taxonomyArguments['rewrite']['slug'] = 'portfolio_category';
	$taxonomyArguments['show_in_rest'] = true;
  
	return $taxonomyArguments;
	
  }
  
add_filter('libwp_taxonomy_1_arguments', 'wp_indigo_modify_libwp_taxonomy_argument');

}