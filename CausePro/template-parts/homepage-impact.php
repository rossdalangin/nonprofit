<?php
/**
 * Template part for displaying the Impact section on the homepage.
 *
 * @package CausePro
 */

// Get section settings
$headline = get_theme_mod( 'causepro_impact_headline', __( 'Our Impact', 'causepro' ) );

// Generate background styles
$bg_style = '';
$bg_type = get_theme_mod( 'causepro_impact_bg_type', 'color' ); // Default to color for this section
if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr(get_theme_mod('causepro_impact_bg_color')) . ';"';
} elseif ($bg_type === 'gradient') {
    $grad1 = esc_attr(get_theme_mod('causepro_impact_bg_gradient_1'));
    $grad2 = esc_attr(get_theme_mod('causepro_impact_bg_gradient_2'));
    $bg_style = 'style="background-image: linear-gradient(to right, ' . $grad1 . ', ' . $grad2 . ');"';
} elseif ($bg_type === 'image') {
    $bg_image_url = get_theme_mod('causepro_impact_bg_image');
    if (!empty($bg_image_url)) {
        $bg_style = 'style="background-image: url(' . esc_url($bg_image_url) . ');"';
    }
}
?>

<section id="impact-section" class="homepage-section impact-section" <?php echo $bg_style; ?>>
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="impact-stats-grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) :
				$number = get_theme_mod( "causepro_impact_stat_{$i}_number", "10,000+" );
				$label  = get_theme_mod( "causepro_impact_stat_{$i}_label", "People Helped" );
				$icon   = get_theme_mod( "causepro_impact_stat_{$i}_icon", "dashicons-groups" );
				?>
				<div id="impact-stat-<?php echo $i; ?>" class="impact-stat">
					<?php if ( ! empty( $icon ) ) : ?>
						<div class="stat-icon-wrapper">
							<span class="stat-icon dashicons-before <?php echo esc_attr( $icon ); ?>"></span>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $number ) ) : ?>
						<p class="stat-number"><?php echo esc_html( $number ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $label ) ) : ?>
						<p class="stat-label"><?php echo esc_html( $label ); ?></p>
					<?php endif; ?>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>
