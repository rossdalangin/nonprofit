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

	// --- Typography Section ---
	$wp_customize->add_section( 'causepro_typography_section', array(
		'title' => __( 'Typography', 'causepro' ),
		'panel' => 'causepro_theme_options_panel',
	) );

	$google_fonts = array(
		'Lato' => 'Lato',
		'Montserrat' => 'Montserrat',
		'Open Sans' => 'Open Sans',
		'Roboto' => 'Roboto',
		'Merriweather' => 'Merriweather',
		'Playfair Display' => 'Playfair Display',
	);
	$web_safe_fonts = array(
		'Arial, Helvetica, sans-serif' => 'Arial',
		'Georgia, serif' => 'Georgia',
		'"Times New Roman", Times, serif' => 'Times New Roman',
		'"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif' => 'Trebuchet MS',
		'Verdana, Geneva, sans-serif' => 'Verdana',
	);
	$all_fonts = array_merge( array('default' => __( 'Theme Default', 'causepro' ) ), $google_fonts, $web_safe_fonts );

	$wp_customize->add_setting( 'causepro_body_font', array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'causepro_body_font', array(
		'label'   => __( 'Global Body Font', 'causepro' ),
		'section' => 'causepro_typography_section',
		'type'    => 'select',
		'choices' => $all_fonts,
	) );

	// Font Size Controls
	$font_size_settings = array(
		'p'  => array( 'label' => __( 'Paragraph Font Size (rem)', 'causepro' ), 'default' => 1 ),
		'h1' => array( 'label' => __( 'H1 Font Size (rem)', 'causepro' ), 'default' => 2.8 ),
		'h2' => array( 'label' => __( 'H2 Font Size (rem)', 'causepro' ), 'default' => 2.5 ),
		'h3' => array( 'label' => __( 'H3 Font Size (rem)', 'causepro' ), 'default' => 1.8 ),
		'h4' => array( 'label' => __( 'H4 Font Size (rem)', 'causepro' ), 'default' => 1.5 ),
		'h5' => array( 'label' => __( 'H5 Font Size (rem)', 'causepro' ), 'default' => 1.2 ),
		'h6' => array( 'label' => __( 'H6 Font Size (rem)', 'causepro' ), 'default' => 1 ),
	);

	foreach ( $font_size_settings as $slug => $details ) {
		$wp_customize->add_setting( "causepro_fontsize_{$slug}", array(
			'default'           => $details['default'],
			'sanitize_callback' => 'abs',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "causepro_fontsize_{$slug}", array(
			'label'       => $details['label'],
			'section'     => 'causepro_typography_section',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 0.5, 'max' => 5, 'step' => 0.1 ),
		) );
	}

	// --- Advanced Colors Section ---
	$wp_customize->add_section( 'causepro_advanced_colors_section', array(
		'title' => __( 'Advanced Colors', 'causepro' ),
		'panel' => 'causepro_theme_options_panel',
	) );
	$color_settings = array(
		'header_bg' => array( 'label' => __( 'Header Background', 'causepro' ), 'default' => '#ffffff' ),
		'header_text' => array( 'label' => __( 'Header Text', 'causepro' ), 'default' => '#333333' ),
		'header_link' => array( 'label' => __( 'Header Link', 'causepro' ), 'default' => '#3498db' ),
		'footer_bg' => array( 'label' => __( 'Footer Background', 'causepro' ), 'default' => '#2c3e50' ),
		'footer_text' => array( 'label' => __( 'Footer Text', 'causepro' ), 'default' => '#ffffff' ),
		'footer_link' => array( 'label' => __( 'Footer Link', 'causepro' ), 'default' => '#bdc3c7' ),
		'body_text' => array( 'label' => __( 'Body Text', 'causepro' ), 'default' => '#333333' ),
		'headings_text' => array( 'label' => __( 'Headings Text', 'causepro' ), 'default' => '#333333' ),
		'link_color' => array( 'label' => __( 'Link Color', 'causepro' ), 'default' => '#3498db' ),
		'link_hover_color' => array( 'label' => __( 'Link Hover Color', 'causepro' ), 'default' => '#2980b9' ),
	);
	foreach ( $color_settings as $slug => $details ) {
		$wp_customize->add_setting( "causepro_color_{$slug}", array( 'default' => $details['default'], 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "causepro_color_{$slug}", array(
			'label'   => $details['label'],
			'section' => 'causepro_advanced_colors_section',
		) ) );
	}


	// --- Homepage Sections Panel ---
	$wp_customize->add_panel( 'causepro_homepage_panel', array(
		'title'       => __( 'Homepage Sections', 'causepro' ),
		'priority'    => 20,
	) );

	// Define sections
	$homepage_sections = array(
		'hero'         => array( 'title' => __( 'Hero Section', 'causepro' ), 'order' => 10 ),
		'impact'       => array( 'title' => __( 'Our Impact Section', 'causepro' ), 'order' => 20 ),
		'causes'       => array( 'title' => __( 'Current Causes Section', 'causepro' ), 'order' => 30 ),
		'campaign'     => array( 'title' => __( 'Campaign Feature Section', 'causepro' ), 'order' => 40 ),
		'testimonials' => array( 'title' => __( 'Testimonials Section', 'causepro' ), 'order' => 50 ),
		'blog'         => array( 'title' => __( 'Blog Section', 'causepro' ), 'order' => 60 ),
		'events'       => array( 'title' => __( 'Upcoming Events Section', 'causepro' ), 'order' => 70 ),
	);

	// Loop through sections to create settings and controls
	foreach ( $homepage_sections as $slug => $details ) {
		$section_id = "causepro_{$slug}_section";

		// Add section
		$wp_customize->add_section( $section_id, array(
			'title' => $details['title'],
			'panel' => 'causepro_homepage_panel',
		) );

		// Show/Hide setting
		$wp_customize->add_setting( "causepro_{$slug}_show", array(
			'default'           => true,
			'sanitize_callback' => 'causepro_sanitize_checkbox',
		) );
		$wp_customize->add_control( "causepro_{$slug}_show", array(
			'label'   => __( 'Show this section', 'causepro' ),
			'section' => $section_id,
			'type'    => 'checkbox',
			'priority' => 1,
		) );

		// Order setting
		$wp_customize->add_setting( "causepro_{$slug}_order", array(
			'default'           => $details['order'],
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( "causepro_{$slug}_order", array(
			'label'   => __( 'Section Order', 'causepro' ),
			'section' => $section_id,
			'type'    => 'number',
			'priority' => 2,
		) );

		// Background controls
		$wp_customize->add_setting( "causepro_{$slug}_bg_type", array(
			'default'           => 'none',
			'sanitize_callback' => 'sanitize_key',
		) );
		$wp_customize->add_control( "causepro_{$slug}_bg_type", array(
			'label'   => __( 'Background Type', 'causepro' ),
			'section' => $section_id,
			'type'    => 'select',
			'choices' => array(
				'none'     => __( 'None', 'causepro' ),
				'color'    => __( 'Color', 'causepro' ),
				'gradient' => __( 'Gradient', 'causepro' ),
				'image'    => __( 'Image', 'causepro' ),
			),
			'priority' => 3,
		) );

		$wp_customize->add_setting( "causepro_{$slug}_bg_color", array( 'default' => '#f9f9f9', 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "causepro_{$slug}_bg_color", array(
			'label'   => __( 'Background Color', 'causepro' ),
			'section' => $section_id,
			'priority' => 4,
			'active_callback' => function() use ($slug) { return get_theme_mod("causepro_{$slug}_bg_type") === 'color'; },
		) ) );

		$wp_customize->add_setting( "causepro_{$slug}_bg_gradient_1", array( 'default' => '#3498db', 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "causepro_{$slug}_bg_gradient_1", array(
			'label'   => __( 'Gradient Color 1', 'causepro' ),
			'section' => $section_id,
			'priority' => 5,
			'active_callback' => function() use ($slug) { return get_theme_mod("causepro_{$slug}_bg_type") === 'gradient'; },
		) ) );

		$wp_customize->add_setting( "causepro_{$slug}_bg_gradient_2", array( 'default' => '#2980b9', 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "causepro_{$slug}_bg_gradient_2", array(
			'label'   => __( 'Gradient Color 2', 'causepro' ),
			'section' => $section_id,
			'priority' => 6,
			'active_callback' => function() use ($slug) { return get_theme_mod("causepro_{$slug}_bg_type") === 'gradient'; },
		) ) );

		$wp_customize->add_setting( "causepro_{$slug}_bg_image", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "causepro_{$slug}_bg_image", array(
			'label'   => __( 'Background Image', 'causepro' ),
			'section' => $section_id,
			'priority' => 7,
			'active_callback' => function() use ($slug) { return get_theme_mod("causepro_{$slug}_bg_type") === 'image'; },
		) ) );
	}

	// --- Content Controls (re-adding them to their sections) ---

	// Hero Section Content
	$wp_customize->add_setting( 'causepro_hero_headline', array( 'default' => __( 'Your Support Changes Lives. See How.', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_hero_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_hero_section', 'type' => 'text', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_hero_button_text', array( 'default' => __( 'Donate Now', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_hero_button_text', array( 'label' => __( 'Button Text', 'causepro' ), 'section' => 'causepro_hero_section', 'type' => 'text', 'priority' => 11 ) );

	// Impact Section Content
	$wp_customize->add_setting( 'causepro_impact_headline', array( 'default' => __( 'Our Impact', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_impact_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_impact_section', 'priority' => 10 ) );
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_number", array( 'default' => "10,000+", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_number", array( 'label' => sprintf( __( 'Stat %d Number/Text', 'causepro' ), $i ), 'section' => 'causepro_impact_section', 'priority' => 10 + $i*3 - 2 ) );
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_label", array( 'default' => "People Helped", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_label", array( 'label' => sprintf( __( 'Stat %d Label', 'causepro' ), $i ), 'section' => 'causepro_impact_section', 'priority' => 10 + $i*3 - 1 ) );
		$wp_customize->add_setting( "causepro_impact_stat_{$i}_icon", array( 'default' => 'dashicons-groups', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_control( "causepro_impact_stat_{$i}_icon", array( 'label' => sprintf( __( 'Stat %d Icon', 'causepro' ), $i ), 'section' => 'causepro_impact_section', 'priority' => 10 + $i*3 ) );
	}

	// Causes Section Content
	$wp_customize->add_setting( 'causepro_causes_headline', array( 'default' => __( 'Join a Cause', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_causes_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_causes_section', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_causes_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'causepro_causes_count', array( 'label' => __( 'Number of Causes to Show', 'causepro' ), 'section' => 'causepro_causes_section', 'type' => 'number', 'priority' => 11 ) );

	// Campaign Section Content
	$wp_customize->add_setting( 'causepro_campaign_headline', array( 'default' => __( 'Featured Campaign', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_campaign_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_campaign_section', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_campaign_text', array( 'default' => __( 'Help us reach our goal!', 'causepro' ), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_campaign_text', array( 'label' => __( 'Text', 'causepro' ), 'section' => 'causepro_campaign_section', 'type' => 'textarea', 'priority' => 11 ) );
	$wp_customize->add_setting( 'causepro_campaign_goal', array( 'default' => 50000, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_campaign_goal', array( 'label' => __( 'Goal Amount', 'causepro' ), 'section' => 'causepro_campaign_section', 'type' => 'number', 'priority' => 12 ) );
	$wp_customize->add_setting( 'causepro_campaign_raised', array( 'default' => 21000, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_campaign_raised', array( 'label' => __( 'Amount Raised', 'causepro' ), 'section' => 'causepro_campaign_section', 'type' => 'number', 'priority' => 13 ) );
	$wp_customize->add_setting( 'causepro_campaign_button_text', array( 'default' => __( 'Contribute', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_campaign_button_text', array( 'label' => __( 'Button Text', 'causepro' ), 'section' => 'causepro_campaign_section', 'priority' => 14 ) );
	$wp_customize->add_setting( 'causepro_campaign_button_link', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'causepro_campaign_button_link', array( 'label' => __( 'Button Link', 'causepro' ), 'section' => 'causepro_campaign_section', 'type' => 'url', 'priority' => 15 ) );

	// Events Section Content
	$wp_customize->add_setting( 'causepro_events_headline', array( 'default' => __( 'Upcoming Events', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_events_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_events_section', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_events_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'causepro_events_count', array( 'label' => __( 'Number of Events to Show', 'causepro' ), 'section' => 'causepro_events_section', 'type' => 'number', 'priority' => 11 ) );

	// Testimonials Section Content
	$wp_customize->add_setting( 'causepro_testimonials_headline', array( 'default' => __( 'What People Are Saying', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_testimonials_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_testimonials_section', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_testimonials_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'causepro_testimonials_count', array( 'label' => __( 'Number of Testimonials to Show', 'causepro' ), 'section' => 'causepro_testimonials_section', 'type' => 'number', 'priority' => 11 ) );

	// Blog Section Content
	$wp_customize->add_setting( 'causepro_blog_headline', array( 'default' => __( 'From Our Blog', 'causepro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'causepro_blog_headline', array( 'label' => __( 'Headline', 'causepro' ), 'section' => 'causepro_blog_section', 'priority' => 10 ) );
	$wp_customize->add_setting( 'causepro_blog_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'causepro_blog_count', array( 'label' => __( 'Number of Posts to Show', 'causepro' ), 'section' => 'causepro_blog_section', 'type' => 'number', 'priority' => 11 ) );
}
add_action( 'customize_register', 'causepro_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function causepro_customize_preview_js() {
	wp_enqueue_script( 'causepro-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CAUSEPRO_VERSION, true );
}
add_action( 'customize_preview_init', 'causepro_customize_preview_js' );
