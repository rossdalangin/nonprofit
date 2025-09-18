<?php
/**
 * CausePro Theme Customizer
 *
 * @package CausePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function causepro_customize_register( $wp_customize ) {
	// --- Sanitize Functions ---
	function causepro_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	function causepro_sanitize_ordering( $value ) {
		$value = sanitize_text_field( $value );
		$value = str_replace( ' ', '', $value );
		$value = explode( ',', $value );
		$value = array_map( 'sanitize_key', $value );
		return implode( ',', array_filter( $value ) );
	}

	// --- Theme Options Panel ---
	$wp_customize->add_panel( 'causepro_theme_options_panel', array(
		'title'       => __( 'Theme Options', 'causepro' ),
		'priority'    => 10,
	) );

	// Donation Link Section
	$wp_customize->add_section( 'causepro_donation_section', array(
		'title'       => __( 'Donation Link', 'causepro' ),
		'panel'       => 'causepro_theme_options_panel',
	) );
	$wp_customize->add_setting( 'causepro_donation_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_donation_link', array(
		'label'       => __( 'Global Donation Link', 'causepro' ),
		'description' => __( 'This link will be used for all main "Donate Now" buttons.', 'causepro' ),
		'section'     => 'causepro_donation_section',
		'type'        => 'url',
	) );

	// Colors Section
	$wp_customize->add_section( 'causepro_colors_section', array(
		'title'       => __( 'Colors', 'causepro' ),
		'panel'       => 'causepro_theme_options_panel',
	) );
	$wp_customize->add_setting( 'causepro_accent_color', array(
		'default'           => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'causepro_accent_color', array(
		'label'       => __( 'Primary Accent Color', 'causepro' ),
		'section'     => 'causepro_colors_section',
	) ) );

	// Footer Section
	$wp_customize->add_section( 'causepro_footer_section', array(
		'title'       => __( 'Footer', 'causepro' ),
		'panel'       => 'causepro_theme_options_panel',
	) );
	$wp_customize->add_setting( 'causepro_copyright_text', array(
		'default'           => sprintf( 'Copyright &copy; %s %s', date( 'Y' ), get_bloginfo( 'name' ) ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_copyright_text', array(
		'label'       => __( 'Footer Copyright Text', 'causepro' ),
		'section'     => 'causepro_footer_section',
		'type'        => 'textarea',
	) );


	// --- Homepage Sections Panel ---
	$wp_customize->add_panel( 'causepro_homepage_panel', array(
		'title'       => __( 'Homepage Sections', 'causepro' ),
		'priority'    => 20,
	) );

	// Section Order
	$wp_customize->add_section( 'causepro_homepage_order_section', array(
		'title'       => __( 'Section Order & Visibility', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
		'priority'    => 1,
	) );
	$wp_customize->add_setting( 'causepro_homepage_sections_order', array(
		'default'           => 'hero,impact,causes,campaign,events',
		'sanitize_callback' => 'causepro_sanitize_ordering',
	) );
	$wp_customize->add_control( 'causepro_homepage_sections_order', array(
		'label'       => __( 'Homepage Section Order', 'causepro' ),
		'description' => __( 'Enter the section IDs in the order you want them to appear, separated by commas. Available sections: hero, impact, causes, campaign, events.', 'causepro' ),
		'section'     => 'causepro_homepage_order_section',
		'type'        => 'text',
	) );


	// Hero Section
	$wp_customize->add_section( 'causepro_hero_section', array(
		'title'       => __( 'Hero Section', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
	) );
	$wp_customize->add_setting( 'causepro_hero_headline', array(
		'default'           => __( 'Your Support Changes Lives. See How.', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_hero_headline', array(
		'label'   => __( 'Headline', 'causepro' ),
		'section' => 'causepro_hero_section',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'causepro_hero_button_text', array(
		'default'           => __( 'Donate Now', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_hero_button_text', array(
		'label'   => __( 'Button Text', 'causepro' ),
		'section' => 'causepro_hero_section',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'causepro_hero_bg_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'causepro_hero_bg_image', array(
		'label'   => __( 'Background Image', 'causepro' ),
		'section' => 'causepro_hero_section',
	) ) );

	// Impact Section
	$wp_customize->add_section( 'causepro_impact_section', array(
		'title'       => __( 'Our Impact Section', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
	) );
	$wp_customize->add_setting( 'causepro_impact_headline', array(
		'default'           => __( 'Our Impact', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_impact_headline', array(
		'label'   => __( 'Headline', 'causepro' ),
		'section' => 'causepro_impact_section',
	) );
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_number", array(
			'default'           => "10,000+",
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_number", array(
			'label'   => sprintf( __( 'Stat %d Number/Text', 'causepro' ), $i ),
			'section' => 'causepro_impact_section',
		) );
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_label", array(
			'default'           => "People Helped",
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_label", array(
			'label'   => sprintf( __( 'Stat %d Label', 'causepro' ), $i ),
			'section' => 'causepro_impact_section',
		) );
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_icon", array(
			'default'           => 'dashicons-groups',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_icon", array(
			'label'       => sprintf( __( 'Stat %d Icon', 'causepro' ), $i ),
			'description' => __( 'Enter a Dashicon class name (e.g., dashicons-heart).', 'causepro' ),
			'section'     => 'causepro_impact_section',
		) );
	}

	// Current Causes Section
	$wp_customize->add_section( 'causepro_causes_section', array(
		'title'       => __( 'Current Causes Section', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
	) );
	$wp_customize->add_setting( 'causepro_causes_headline', array(
		'default'           => __( 'Join a Cause', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_causes_headline', array(
		'label'   => __( 'Headline', 'causepro' ),
		'section' => 'causepro_causes_section',
	) );
	$wp_customize->add_setting( 'causepro_causes_count', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'causepro_causes_count', array(
		'label'   => __( 'Number of Causes to Show', 'causepro' ),
		'section' => 'causepro_causes_section',
		'type'    => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 9, 'step' => 1 ),
	) );

	// Campaign Feature Section
	$wp_customize->add_section( 'causepro_campaign_section', array(
		'title'       => __( 'Campaign Feature Section', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
	) );
	$wp_customize->add_setting( 'causepro_campaign_headline', array(
		'default'           => __( 'Featured Campaign', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_campaign_headline', array(
		'label'   => __( 'Headline', 'causepro' ),
		'section' => 'causepro_campaign_section',
	) );
	$wp_customize->add_setting( 'causepro_campaign_text', array(
		'default'           => __( 'Help us reach our goal to build a new community center. Every contribution makes a difference!', 'causepro' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_campaign_text', array(
		'label'   => __( 'Text', 'causepro' ),
		'section' => 'causepro_campaign_section',
		'type'    => 'textarea',
	) );
	$wp_customize->add_setting( 'causepro_campaign_goal', array(
		'default'           => 50000,
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_campaign_goal', array(
		'label'   => __( 'Goal Amount', 'causepro' ),
		'section' => 'causepro_campaign_section',
		'type'    => 'number',
	) );
	$wp_customize->add_setting( 'causepro_campaign_raised', array(
		'default'           => 21000,
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_campaign_raised', array(
		'label'   => __( 'Amount Raised', 'causepro' ),
		'section' => 'causepro_campaign_section',
		'type'    => 'number',
	) );
	$wp_customize->add_setting( 'causepro_campaign_button_text', array(
		'default'           => __( 'Contribute to Campaign', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_campaign_button_text', array(
		'label'   => __( 'Button Text', 'causepro' ),
		'section' => 'causepro_campaign_section',
	) );
	$wp_customize->add_setting( 'causepro_campaign_button_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'causepro_campaign_button_link', array(
		'label'   => __( 'Button Link', 'causepro' ),
		'section' => 'causepro_campaign_section',
		'type'    => 'url',
	) );

	// Upcoming Events Section
	$wp_customize->add_section( 'causepro_events_section', array(
		'title'       => __( 'Upcoming Events Section', 'causepro' ),
		'panel'       => 'causepro_homepage_panel',
	) );
	$wp_customize->add_setting( 'causepro_events_headline', array(
		'default'           => __( 'Upcoming Events', 'causepro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'causepro_events_headline', array(
		'label'   => __( 'Headline', 'causepro' ),
		'section' => 'causepro_events_section',
	) );
	$wp_customize->add_setting( 'causepro_events_count', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'causepro_events_count', array(
		'label'   => __( 'Number of Events to Show', 'causepro' ),
		'section' => 'causepro_events_section',
		'type'    => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 6, 'step' => 1 ),
	) );
}
add_action( 'customize_register', 'causepro_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function causepro_customize_preview_js() {
	wp_enqueue_script( 'causepro-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CAUSEPRO_VERSION, true );
}
add_action( 'customize_preview_init', 'causepro_customize_preview_js' );
