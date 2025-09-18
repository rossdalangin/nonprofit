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
	// Define all possible sections
	$possible_sections = array( 'hero', 'impact', 'causes', 'campaign', 'testimonials', 'blog', 'events' );

	$sections_to_display = array();

	// Check which sections are enabled and get their order
	foreach ( $possible_sections as $section_slug ) {
		if ( get_theme_mod( 'causepro_' . $section_slug . '_show', true ) ) {
			$sections_to_display[] = array(
				'slug'  => $section_slug,
				'order' => get_theme_mod( 'causepro_' . $section_slug . '_order', 10 ),
			);
		}
	}

	// Sort the sections based on their order
	usort( $sections_to_display, function( $a, $b ) {
		return $a['order'] - $b['order'];
	} );

	// Loop through the sorted sections and load the template parts
	foreach ( $sections_to_display as $section ) {
		get_template_part( 'template-parts/homepage', $section['slug'] );
	}
	?>

</main><!-- #main -->

<?php
get_footer();
