<?php
/**
 * Theme Customizer
 *
 * @package cwp
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_control('header_textcolor');

	/* theme notes */
	$wp_customize->add_section( 'codeinwp_theme_notes' , array(
		'title'      => __('ThemeIsle theme notes','codeinwp'),
		'description' => sprintf( __( "Thank you for being part of this! We've spent almost 6 months building ThemeIsle without really knowing if anyone will ever use a theme or not, so we're very grateful that you've decided to work with us. Wanna <a href='http://themeisle.com/contact/' target='_blank'>say hi</a>?
		<br/><br/><a href='http://themeisle.com/demo/?theme=MetroX' target='_blank' />View Theme Demo</a> | <a href='http://themeisle.com/forums/forum/metrox/' target='_blank'>Get theme support</a>")),
		'priority'   => 30,
	));
	$wp_customize->add_setting(
        'cwp_theme_notice'
	);

	$wp_customize->add_control(
    'cwp_theme_notice',
    array(
        'section' => 'codeinwp_theme_notes',
		'type'  => 'read-only',
    ));

	$wp_customize->add_section( 'codeinwp_logo_section' , array(
    	'title'       => __( 'Logo', 'metrox' ),
    	'priority'    => 30,
    	'description' => __('Upload a logo to replace the default site name and description in the header','metrox'),
	) );

	$wp_customize->add_setting( 'codeinwp_logo',
        array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
	    'label'    => __( 'Logo', 'metrox' ),
	    'section'  => 'codeinwp_logo_section',
	    'settings' => 'codeinwp_logo',
	) ) );


	/* Socials */
	$wp_customize->add_section( 'codeinwp_socials_section' , array(
    	'title'       => __( 'Socials', 'metrox' ),
    	'priority'    => 31,
	) );

	$wp_customize->add_setting( 'codeinwp_social_link_fb', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( 'codeinwp_social_link_fb', array(
	    'label'    => __( 'Facebook link', 'metrox' ),
	    'section'  => 'codeinwp_socials_section',
	    'settings' => 'codeinwp_social_link_fb',

		'priority'    => 5,
	) );
	$wp_customize->add_setting( 'codeinwp_social_link_tw', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( 'codeinwp_social_link_tw', array(
	    'label'    => __( 'Twitter link', 'metrox' ),
	    'section'  => 'codeinwp_socials_section',
	    'settings' => 'codeinwp_social_link_tw',
		'priority'    => 10,
	) );

}
add_action( 'customize_register', 'cwp_customize_register' );

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cwp_customize_preview_js() {
	wp_enqueue_script( 'customizerJS', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), '20131205', true );
}
add_action( 'customize_preview_init', 'cwp_customize_preview_js' );