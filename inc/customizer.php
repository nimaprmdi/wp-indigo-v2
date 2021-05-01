<?php
/**
 * wp-indigo Theme Customizer
 *
 * @package wp-indigo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_indigo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wp_indigo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wp_indigo_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'wp_indigo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_indigo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_indigo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_indigo_customize_preview_js() {
	wp_enqueue_script( 'wp-indigo-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), WP_INDIGO_VERSION, true );
}
add_action( 'customize_preview_init', 'wp_indigo_customize_preview_js' );



/* Kirki  */
if( function_exists( 'kirki' ) ) {


	/*
	 *	Kirki - Config
	 */
	Kirki::add_config( 'wp_indigo_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );


	/*
	 *	Kirki -> Panels
	 */

	// Footer
	Kirki::add_panel( 'footer', array(
		'priority' => 180,
		'title'    => esc_html__( 'Footer', 'wp_indigo' ),
	) );

	/*
	 *	Kirki -> Sections
	 */

	/* Social medias */
	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Socials', 'wp_indigo' ),
		'panel'    => 'footer',
		'priority' => 6,
	) );

 	/*
    *	Kirki -> fields
	*/
	
	// -- Socials --
	Kirki::add_field( 'wp_indigo', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'wp_indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'wp_indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'wp_indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => esc_html__( 'Linkedin', 'wp_indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );
	
	Kirki::add_field( 'wp_indigo', [
		'type'     => 'link',
		'settings' => 'github',
		'label'    => esc_html__( 'Github', 'wp_indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );
	
}