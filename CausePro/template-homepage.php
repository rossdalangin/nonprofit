<?php
/**
 * Template Name: Homepage
 *
 * The template for displaying the homepage.
 *
 * @package CausePro
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	// Get the order from the Customizer
	$sections_order_str = get_theme_mod( 'causepro_homepage_sections_order', 'hero,impact,causes,campaign,events' );
	$sections_order = explode( ',', $sections_order_str );

	// Loop through the sections and load the template parts
	foreach ( $sections_order as $section ) {
		$section_slug = trim( $section );
		if ( ! empty( $section_slug ) ) {
			get_template_part( 'template-parts/homepage', $section_slug );
		}
	}
	?>

</main><!-- #main -->

<?php
get_footer();
