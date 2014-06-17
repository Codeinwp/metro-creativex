<?php
/**
 * Theme Customizer
 *
 * @package metrox
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function metrox_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_control('header_textcolor');
	
	/* theme notes */
	$wp_customize->add_section( 'metrox_theme_notes' , array(
		'title'      => __('ThemeIsle theme notes','metrox'),
		'description' => sprintf( __( "Thank you for being part of this! We've spent almost 6 months building ThemeIsle without really knowing if anyone will ever use a theme or not, so we're very grateful that you've decided to work with us. Wanna <a href='http://themeisle.com/contact/' target='_blank'>say hi</a>?
		<br/><br/><a href='http://themeisle.com/demo/?theme=MetroX' target='_blank' />View Theme Demo</a> | <a href='http://themeisle.com/forums/forum/metrox' target='_blank'>Get theme support</a><br/><br/><a href='http://themeisle.com/documentation-metrox' target='_blank'>Documentation</a>")),
		'priority'   => 30,
	));
	$wp_customize->add_setting(
        'metrox_theme_notice'
	);
	
	$wp_customize->add_control(
    'metrox_theme_notice',
    array(
        'section' => 'metrox_theme_notes',
		'type'  => 'read-only',
    ));
	
	/* logo */
	$wp_customize->add_section( 'metrox_logo_section' , array(
    	'title'       => __( 'Logo', 'metrox' ),
    	'priority'    => 30,
    	'description' => __('Upload a logo to replace the default site name and description in the header','metrox'),
	) );

	$wp_customize->add_setting( 'metrox_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
	    'label'    => __( 'Logo', 'metrox' ),
	    'section'  => 'metrox_logo_section',
	    'settings' => 'metrox_logo',
	) ) );
	

	/* Socials */
	$wp_customize->add_section( 'metrox_socials_section' , array(
    	'title'       => __( 'Socials', 'metrox' ),
    	'priority'    => 31,
	) );

	$wp_customize->add_setting( 'metrox_social_link_fb', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( 'metrox_social_link_fb', array(
	    'label'    => __( 'Facebook link', 'metrox' ),
	    'section'  => 'metrox_socials_section',
	    'settings' => 'metrox_social_link_fb',
		'priority'    => 5,
	) );
	$wp_customize->add_setting( 'metrox_social_link_tw', array('sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( 'metrox_social_link_tw', array(
	    'label'    => __( 'Twitter link', 'metrox' ),
	    'section'  => 'metrox_socials_section',
	    'settings' => 'metrox_social_link_tw',
		'priority'    => 10,
	) );

}
add_action( 'customize_register', 'metrox_customize_register' );

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function metrox_customize_preview_js() {
	wp_enqueue_script( 'customizerJS', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), '20131205', true );
}
add_action( 'customize_preview_init', 'metrox_customize_preview_js' );